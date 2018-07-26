<!DOCTYPE html>
<html lang="en">
<head>
  <title>Jell</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://unpkg.com/vue"></script>
	<script>
	function calculateTimeCost(ref) {
		//start: set the values of each fields
		var minhour = document.getElementById('minhour').value;
		var time  = document.getElementById('time').value;
		var cost = document.getElementById('cost').value;
		var worktype = document.getElementById('worktype').value;
		if(isNaN(time)) {
			alert('Please enter a numeric for Time');
			return false;
		}
		if(isNaN(cost)) {
			alert('Please enter a numeric for Cost');
			return false;
		}
		//end: set the values of each fields
		
		if(ref=='minhour' && minhour=='h'){
			//only use this condition if the minutes was changed into hours then take the time and divide by 60
			time = (time/60);
		} 
		if(ref=='minhour' && minhour=='m'){
			//only use this condition if the minutes was changed into minutes then take the time and multiply by 60
			time = (time*60);
		}
		
		if(ref=='cost'){
			//if cost was changed, take that value and set the time value
			if(minhour=='m') {
				var a = ((cost/worktype)*60);
				document.getElementById('time').value = a.toFixed(2);
			} else {
				var a = (cost/worktype);
				document.getElementById('time').value = a.toFixed(2);
			}
		} else {
			//if time was changed, take that value and set the time cost
			document.getElementById('time').value = time;
			if(minhour=='m') {
				var a = ((time*worktype)/60);
				document.getElementById('cost').value = a.toFixed(2);
			} else {
				var a = (time*worktype);
				document.getElementById('cost').value = a.toFixed(2);
			}
		} 
	}
	function roundUpDown(flag) {
		if(document.getElementById('minhour').value=='h') {
			alert('Please select Minutes');
			return false;
		}
		if(flag=='up') {
			//this will round the time to the next incremental value of 15
			document.getElementById('time').value = Math.ceil((Number(document.getElementById('time').value)+0)/15)*15;
		} 
		if(flag=='down') {
			//this will round the time to the previous incremental value of 15
			document.getElementById('time').value = (Math.ceil((Number(document.getElementById('time').value)+1)/15)*15)-15;
		}
		calculateTimeCost();
	}
	</script>
</head>
<body>


<div class="container" style="max-width: 500px">
  <h2>Cost/Time Calculator</h2>
  <form class="form-horizontal">
    <div class="form-group">
      <label class="control-label col-sm-3">Work Type:</label>
      <div class="col-sm-9">
				
				<select id="worktype" class="form-control" onChange="calculateTimeCost(); return false;">
					<option v-for="option in options" v-bind:value="option.value">
						@{{ option.text }}
					</option>
				</select>
				
      </div>
    </div>
		<div class="form-group">
      <label class="control-label col-sm-3">Time:</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="time" value="60" onChange="calculateTimeCost('time'); return false;">
      </div>
			<div class="col-sm-4">
				<select class="form-control" id="minhour" onChange="calculateTimeCost('minhour'); return false;">
					<option value="m">Minutes</option>
					<option value="h">Hours</option>			
				</select>
			</div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-3">Cost:</label>
      <div class="col-sm-9">          
        <input type="text" class="form-control" id="cost" placeholder="$" onChange="calculateTimeCost('cost'); return false;">
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-12">
        <button type="submit" class="btn btn-default" style="width: 100%; background-color: #CCCCCC;" onClick="roundUpDown('up'); return false;">Round up to the nearest 15 minutes</button>
      </div>
    </div>
		<div class="form-group">        
      <div class="col-sm-12">
        <button type="submit" class="btn btn-default" style="width: 100%; background-color: #CCCCCC;" onClick="roundUpDown('down'); return false;">Round down to the nearest 15 minutes</button>
      </div>
    </div>
  </form>
</div>


<script>
new Vue({
  el: '#worktype',
  data: {
    options: [
      { text: 'Development ($160/hour)', value: 160 },
      { text: 'Design ($120/hour)', value: 120 },
      { text: 'Project Management ($120/hour)', value: 120 },
			{ text: 'Travel ($100/hour)', value: 100 }
    ]
  }
});

/*
var worktype = new Vue({
	el: '#worktype',
	data: {
			getTemp: ''
	},
	created: function () {
			this.fetchData();
	},        
	methods: {
		fetchData: function () {
			this.$http.get('/api/rates'),
				function (data) {
					this.getTemp = data.main.temp;
			}
		}
	}
});
*/

calculateTimeCost();
</script>

</body>
</html>


<!---
    - don't install illuminate/view v5.6.9|don't install laravel/framework v5.5.14                                                                                 
    - Installation request for laravel/framework (locked at v5.5.14, required as 5.5.*) -> satisfiable by laravel/framework[v5.5.14].
--->
