from flask import Flask, render_template
from flaskext.mysql import MySQL
import pandas as pd
from sklearn.cluster import KMeans

app = Flask(__name__)
mysql = MySQL(app)

app.config['MYSQL_DATABASE_USER'] = 'root'
app.config['MYSQL_DATABASE_PASSWORD'] = 'Milu@29'
app.config['MYSQL_DATABASE_DB'] = 'healtogether'
app.config['MYSQL_DATABASE_HOST'] = 'localhost'

mysql.init_app(app)

@app.route('/surveys')
def get_survey_data():
    # Connect to the MySQL database
    cursor = mysql.get_db().cursor()

    # Execute a SELECT query to retrieve data from the 'surveys' table
    cursor.execute("SELECT * FROM surveys")

    # Fetch the data into a Pandas DataFrame
    data = pd.DataFrame(cursor.fetchall(), columns=["id", "q1", "q2", "q3", "q4", "q5", "q6", "q7", "q8", "q9", "q10", "q11", "created_at", "updated_at", "user_id"])

    # Close the database cursor
    cursor.close()

    # Perform clustering using K-Means
    # For example, let's cluster the data based on columns q1, q2, q3
    features = data[["q1", "q2", "q3"]]
    kmeans = KMeans(n_clusters=3)
    data['cluster'] = kmeans.fit_predict(features)

    # Render a template or return the data as a JSON response
    return render_template('surveys.html', data=data)

if __name__ == '__main__':
    app.run(debug=True)
