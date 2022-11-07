<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <title>Broker Insights web api challenge</title>
</head>
<body>
<div class="container" id="searchBroker">
			<br />
			<h1 align="center" class="title">Apache</h1>
			<br />
			<div class="panel">
				<div class="panel-heading">
					<div class="row">
						<div class="col-md-9">
							<h3 class="panel-header">Customer Policies</h3>
						</div>
						<div class="col-md-3" align="right">
							<input type="text" class="form-control form-rounded searchBox" placeholder="Search Policies" v-model="query" @keyup="fetchData()" />
						</div>
					</div>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-dark">
						<thead>
							<tr>
								<th>Customer Name</th>
								<th>Customer Address</th>
								<th>Premium</th>
								<th>Policy Type</th>
								<th>Insurer Name</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="row in policies">
								<td>{{ row.customer_name }}</td>
								<td>{{ row.customer_address }}</td>
								<td>{{ row.premium }}</td>
								<td>{{ row.policy_type }}</td>
								<td>{{ row.insurer_name }}</td>								
							</tr>
							<tr v-if="nodata">
								<td colspan="6" align="center">There are no broker insurances available</td>
							</tr>
						</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
</body>

<script>
var apache = new Vue({
	el:'#searchBroker',
	data:{
		policies:'',
		query:'',
		nodata:false
	},
	methods: {
		fetchData:function(){
			axios.post('app.php', {
				query:this.query
			}).then(function(response){
				if(response.data.length > 0)
				{
					apache.policies = response.data;
					apache.nodata = false;
				}
				else
				{
					apache.policies = '';
					apache.nodata = true;
				}
			});
		}
	},
	created:function(){
		this.fetchData();
	}
});

</script>

<style lang="scss">


body {
	background: linear-gradient(to right, #0096C7, #fefeff,#023E8A);
}

.form-rounded{
	border-radius: 25px;
}

.panel{
	margin-top:20px;
	padding: 0;
    border-radius: 10px;
    border: none;
    box-shadow: 0 0 0 5px rgba(0,0,0,0.05),0 0 0 10px rgba(0,0,0,0.05);
	background: linear-gradient(to right, #2980b9, #2c3e50);
}

th{
	color:#FF5400;
	text-align: center;
}

td{
	color: #fefeff;
	text-align: center;
}

.panel-header{
	color: #fefeff;
}

.title{
	color: #FF8500;
}

.searchBox{
	color: #fff;
    background-color: transparent;
    height: 40px;
    border: 2px solid #fff;
    transition: all 0.3s ease 0s;
}
</style>