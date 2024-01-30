@extends('layout.navbar')
@if(Session::has('success'))
<p class="alert alert-success">{{ Session::get('success') }}</p>
@endif
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Mental Health Survey') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('submit.survey') }}">
                        @csrf

                        <!-- Question 1 -->
                        <div class="form-group">
                            <label for="q1">1. How often do you feel overwhelmed or stressed?</label>
                            <div>
                                <label><input type="radio" name="q1" value="Never"> Never</label>
                                <label><input type="radio" name="q1" value="Rarely"> Rarely</label>
                                <label><input type="radio" name="q1" value="Sometimes"> Sometimes</label>
                                <label><input type="radio" name="q1" value="Often"> Often</label>
                                <label><input type="radio" name="q1" value="Always"> Always</label>
                            </div>
                        </div>

                        <!-- Question 2 -->
                        <div class="form-group">
                            <label for="q2">2. How often do you feel hopeless or depressed?</label>
                            <div>
                                <label><input type="radio" name="q2" value="Never"> Never</label>
                                <label><input type="radio" name="q2" value="Rarely"> Rarely</label>
                                <label><input type="radio" name="q2" value="Sometimes"> Sometimes</label>
                                <label><input type="radio" name="q2" value="Often"> Often</label>
                                <label><input type="radio" name="q2" value="Always"> Always</label>
                            </div>
                        </div>

                        <!-- Question 3 -->
<div class="form-group">
    <label for="q3">3. How often do you have trouble sleeping or concentrating?</label>
    <div>
        <label><input type="radio" name="q3" value="Never"> Never</label>
        <label><input type="radio" name="q3" value="Rarely"> Rarely</label>
        <label><input type="radio" name="q3" value="Sometimes"> Sometimes</label>
        <label><input type="radio" name="q3" value="Often"> Often</label>
        <label><input type="radio" name="q3" value="Always"> Always</label>
    </div>
</div>

<!-- Question 4 -->
<div class="form-group">
    <label for="q4">4. How often do you feel anxious or worried?</label>
    <div>
        <label><input type="radio" name="q4" value="Never"> Never</label>
        <label><input type="radio" name="q4" value="Rarely"> Rarely</label>
        <label><input type="radio" name="q4" value="Sometimes"> Sometimes</label>
        <label><input type="radio" name="q4" value="Often"> Often</label>
        <label><input type="radio" name="q4" value="Always"> Always</label>
    </div>
</div>

<!-- Question 5 -->
<div class="form-group">
    <label for="q5">5. How often do you feel irritable or angry?</label>
    <div>
        <label><input type="radio" name="q5" value="Never"> Never</label>
        <label><input type="radio" name="q5" value="Rarely"> Rarely</label>
        <label><input type="radio" name="q5" value="Sometimes"> Sometimes</label>
        <label><input type="radio" name="q5" value="Often"> Often</label>
        <label><input type="radio" name="q5" value="Always"> Always</label>
    </div>
</div>

<!-- Question 6 -->
<div class="form-group">
    <label for "q6">6. How often do you feel like you're not good enough?</label>
    <div>
        <label><input type="radio" name="q6" value="Never"> Never</label>
        <label><input type="radio" name="q6" value="Rarely"> Rarely</label>
        <label><input type="radio" name="q6" value="Sometimes"> Sometimes</label>
        <label><input type="radio" name="q6" value="Often"> Often</label>
        <label><input type="radio" name="q6" value="Always"> Always</label>
    </div>
</div>

<!-- Question 7 -->
<div class="form-group">
    <label for="q7">7. How often do you feel like you're alone or don't belong?</label>
    <div>
        <label><input type="radio" name="q7" value="Never"> Never</label>
        <label><input type="radio" name="q7" value="Rarely"> Rarely</label>
        <label><input type="radio" name="q7" value="Sometimes"> Sometimes</label>
        <label><input type="radio" name="q7" value="Often"> Often</label>
        <label><input type="radio" name="q7" value="Always"> Always</label>
    </div>
</div>

<!-- Question 8 -->
<div class="form-group">
    <label for="q8">8. How often do you have thoughts of harming yourself or others?</label>
    <div>
        <label><input type="radio" name="q8" value="Never"> Never</label>
        <label><input type="radio" name="q8" value="Rarely"> Rarely</label>
        <label><input type="radio" name="q8" value="Sometimes"> Sometimes</label>
        <label><input type="radio" name="q8" value="Often"> Often</label>
        <label><input type="radio" name="q8" value="Always"> Always</label>
    </div>
</div>

<!-- Question 9 -->
<div class="form-group">
    <label for="q9">9. How satisfied are you with your overall mental health?</label>
    <select name="q9" class="form-control" required>
        <option value="">Select an option</option>
        <option value="Very satisfied">Very satisfied</option>
        <option value="Somewhat satisfied">Somewhat satisfied</option>
        <option value="Neither satisfied nor dissatisfied">Neither satisfied nor dissatisfied</option>
        <option value="Somewhat dissatisfied">Somewhat dissatisfied</option>
        <option value="Very dissatisfied">Very dissatisfied</option>
    </select>
</div>

<!-- Question 10 -->
<div class="form-group">
    <label for="q10">10. Do you have any history of mental illness in your family?</label>
    <div>
        <label><input type="radio" name="q10" value="Yes"> Yes</label>
        <label><input type="radio" name="q10" value="No"> No</label>
        <label><input type="radio" name="q10" value="I don't know"> I don't know</label>
    </div>
</div>

<!-- Question 11 -->
<div class="form-group">
    <label for="q11">11. Have you ever been diagnosed with a mental illness?</label>
    <div>
        <label><input type="radio" name="q11" value="Yes"> Yes</label>
        <label><input type="radio" name="q11" value="No"> No</label>
    </div>
</div>



                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
