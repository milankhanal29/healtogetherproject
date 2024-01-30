# Import the necessary libraries
from flask import Flask,jsonify, render_template
from flaskext.mysql import MySQL
import pandas as pd
from sklearn.cluster import KMeans
from sklearn.impute import SimpleImputer  # Import the SimpleImputer

app = Flask(__name__)
mysql = MySQL(app)

app.config['MYSQL_DATABASE_USER'] = 'root'
app.config['MYSQL_DATABASE_PASSWORD'] = 'Milu@123'
app.config['MYSQL_DATABASE_DB'] = 'healtogether'
app.config['MYSQL_DATABASE_HOST'] = 'localhost'

mysql.init_app(app)
@app.route('/surveys', methods=['POST'])
def get_survey_data():
    # Connect to the MySQL database
    cursor = mysql.get_db().cursor()

    # Execute a SELECT query to retrieve data from the 'surveys' table
    cursor.execute("SELECT * FROM surveys")

    # Fetch the data into a Pandas DataFrame
    data = pd.DataFrame(cursor.fetchall(), columns=["id", "q1", "q2", "q3", "q4", "q5", "q6", "q7", "q8", "q9", "q10", "q11", "created_at", "updated_at", "user_id"])

    # Close the database cursor
    cursor.close()

    # Define a mapping of string values to integer values for label encoding
    label_mapping = {'Never': 0, 'Rarely': 1, 'Sometimes': 2, 'Always': 3, 'Somewhat dissatisfied': 4, "Neither satisfied nor dissatisfied": 5, "I don't know": 6, 'Very satisfied': 7, 'Yes': 8, 'No': 9,'Very dissatisfied':10}

    # Specify the columns to encode
    columns_to_encode = ['q1', 'q2', 'q3', 'q4', 'q5', 'q6', 'q7', 'q8', 'q9', 'q10', 'q11']

    # Create a SimpleImputer to handle missing values by filling them with the most frequent value in each column
    imputer = SimpleImputer(strategy='most_frequent')
    data[columns_to_encode] = imputer.fit_transform(data[columns_to_encode])

    # Apply label encoding to specific columns
    data[columns_to_encode] = data[columns_to_encode].apply(lambda col: col.map(label_mapping))
# Convert the columns to numeric
    data[columns_to_encode] = data[columns_to_encode].apply(pd.to_numeric, errors='coerce')
    data.dropna(subset=columns_to_encode, inplace=True)
    # Perform clustering using K-Means
    features = data[["q1", "q2", "q3","q4","q5","q6","q7","q8","q9","q10","q11"]]
    kmeans = KMeans(n_clusters=3)
    data['cluster'] = kmeans.fit_predict(features)
    clustered_data = data.to_dict(orient='records')


    return jsonify(clustered_data)

if __name__ == '__main__':
    app.run(debug=True)
