
@extends('admin.admin-nav')

@section('landing')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous">
          <link rel="stylesheet" href="path/to/material-bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class=" container col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <h2 class="mt-4">Survey Results</h2>
       <!-- ... (previous code) ... -->

<div class="row">
    <div class="col-md-6">
        <h3 class="question-title">1. How often do you feel overwhelmed or stressed?</h3>
        <canvas id="chart-q1"></canvas>
    </div>
    <div class="col-md-6">
        <h3 class="question-title">2. How often do you feel hopeless or depressed?</h3>
        <canvas id="chart-q2"></canvas>
    </div>
    <div class="col-md-6">
        <h3 class="question-title">3. How often do you have trouble sleeping or concentrating?</h3>
        <canvas id="chart-q3"></canvas>
    </div>
    <div class="col-md-6">
        <h3 class="question-title">4. How often do you feel anxious or worried?</h3>
        <canvas id="chart-q4"></canvas>
    </div>
    <div class="col-md-6">
        <h3 class="question-title">5. How often do you feel irritable or angry?</h3>
        <canvas id="chart-q5"></canvas>
    </div>
    <div class="col-md-6">
        <h3 class="question-title">6. How often do you feel like you're not good enough?</h3>
        <canvas id="chart-q6"></canvas>
    </div>
    <div class="col-md-6">
        <h3 class="question-title">7. How often do you feel like you're alone or don't belong?</h3>
        <canvas id="chart-q7"></canvas>
    </div>
    <div class="col-md-6">
        <h3 class="question-title">8. How often do you have thoughts of harming yourself or others?</h3>
        <canvas id="chart-q8"></canvas>
    </div>
    <div class="col-md-6">
        <h3 class="question-title">9. How satisfied are you with your overall mental health?</h3>
        <canvas id="chart-q9"></canvas>
    </div>
    <div class="col-md-6">
        <h3 class="question-title">10. Do you have any history of mental illness in your family?</h3>
        <canvas id="chart-q10"></canvas>
    </div>
    <div class="col-md-6">
        <h3 class="question-title">11. Have you ever been diagnosed with a mental illness?</h3>
        <canvas id="chart-q11"></canvas>
    </div>
</div>

<!-- Rest of the code... -->

    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function () {

    
        function createPieChart(data, containerId) {
                const ctx = document.getElementById(containerId).getContext('2d');
                new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            data: data.values,
                            backgroundColor: [
                                '#FF5733',
                                '#FFC300',
                                '#36A2EB',
                                '#FF5733',
                                '#36A2EB',
                            ],
                        }],
                    },
                });
            }

            // Sample survey data (replace this with your actual data)
            const surveyData = @json($surveyData);
    console.log(surveyData)
    const chartColors = ['#FF5733', '#FFC300', '#36A2EB', '#8eff00', '#f9dd8e'];
    // Your chart rendering code here

    function createPieChart(data, containerId) {
    const ctx = document.getElementById(containerId).getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: data.labels,
            datasets: [
                {
                    data: data.values, // Replace with an array of numbers
                    backgroundColor: chartColors,
                },
            ],
        },
    });
}
function createChartsForQuestion(questionNumber) {
    let labels, values;

if (questionNumber === 9) {
    labels = ['Very satisfied', 'Somewhat satisfied', 'Neither satisfied nor dissatisfied', 'Somewhat dissatisfied', 'Very dissatisfied'];
    values = labels.map(label => {
        const count = surveyData.filter(user => user[`q${questionNumber}`] === label).length;
        return (count / surveyData.length) * 100;
    });
} else if (questionNumber === 10) {
    labels = ['Yes', 'No', 'I don\'t know'];
    values = labels.map(label => {
        const count = surveyData.filter(user => user[`q${questionNumber}`] === label).length;
        return (count / surveyData.length) * 100;
    });
} else if (questionNumber === 11) {
    labels = ['Yes', 'No'];
    values = labels.map(label => {
        const count = surveyData.filter(user => user[`q${questionNumber}`] === label).length;
        return (count / surveyData.length) * 100;
    });
} else {
    labels = ['Never', 'Rarely', 'Sometimes', 'Often', 'Always'];
    values = labels.map(label => {
        const count = surveyData.filter(user => user[`q${questionNumber}`] === label).length;
        return (count / surveyData.length) * 100;
    });
}

createPieChart({ labels, values }, `chart-q${questionNumber}`);
}

            // Create charts for each question (you can extend this for more questions)
            createChartsForQuestion(1);
            createChartsForQuestion(2);
            createChartsForQuestion(3);
            createChartsForQuestion(4);
            createChartsForQuestion(5);
            createChartsForQuestion(6);
            createChartsForQuestion(7);
            createChartsForQuestion(8);
            createChartsForQuestion(9);
            createChartsForQuestion(10);
            createChartsForQuestion(11);




});
    // Add more charts for other questions...
</script>
@endsection