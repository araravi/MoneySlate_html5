		if ( navigator.onLine ) {
			$('#homehead h1').text("UOMe (Online)");
		} else {
		//append offline text to UOMe on Top
			alert('You are in offline mode');
			$('#homehead h1').text("UOMe (Offline)");
		}

window.addEventListener( 'online', function( event ) {
			//sync with server
			alert( 'Back Online, Syncing data now..' );
			$.mobile.showPageLoadingMsg();
			getExpense(); //this puts expense data followed by payment data on the server and clears database
			getPayment();
			$.mobile.hidePageLoadingMsg();
			} , false);
window.addEventListener( 'offine', function( event ) {
			} , false);

var db = prepareDatabase();
	prepareDatabase2();
	prepareDatabase3();
	var memberExp=new Object();
	var expense=new Object();
	var payment=new Object();
	expense['mem_exp']=new Object();
	
	
var createSQL = 'CREATE TABLE IF NOT EXISTS expense (' +
	'exp_id INTEGER PRIMARY KEY AUTOINCREMENT,' +
	'exp_name VARCHAR(45),' +
	'exp_creator_id VARCHAR,' +
			'exp_category_id INTEGER,' +
			'exp_description VARCHAR(255),' +
			'exp_amount INTEGER,' +
			'exp_paid VARCHAR NULL,' +
			'lat FLOAT NULL,' +
			'long FLOAT NULL,' +
			'date DATE,' +
	'timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP' +
    ')';
	var createSQL2 = 'CREATE TABLE IF NOT EXISTS member_expense (' +
	'id INTEGER PRIMARY KEY AUTOINCREMENT,' +
	'member_id VARCHAR,' +
	'mem_name VARCHAR(100),' +
			'exp_id INTEGER,' +
			'amount FLOAT,' +
			'exp_paid VARCHAR,' +
			'timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP' +
    ')';
	var createSQL3 = 'CREATE TABLE IF NOT EXISTS payment (' +
		'id INTEGER PRIMARY KEY AUTOINCREMENT,' +
		'member_id VARCHAR,' +
		'amount FLOAT,' +
		'original BOOLEAN,' +
		'timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP' +
	')';

	//

// Check if this browser supports Web SQL
function getOpenDatabase() {
    try {
	if( !! window.openDatabase ) return window.openDatabase;
	else return undefined;
    } catch(e) {
	return undefined;
    }
}

// Open the Web SQL database
function prepareDatabase() {
    var odb = getOpenDatabase();
    if(!odb) {
	dispError('Web SQL Not Supported');
	return undefined;
    } else {
	var db = odb( 'UOMe', '1.0', 'UOMe Database 10M', 10 * 1024 * 1024 );
	db.transaction(function (t) {
	    t.executeSql( createSQL, [], function(t, r) {}, function(t, e) {
		alert('create table: ' + e.message);
	    });
	});
	return db;
    }
}
	
	 function prepareDatabase2() {
    var odb = getOpenDatabase();
    if(!odb) {
	dispError('Web SQL Not Supported');
	return undefined;
    } else {
	   db.transaction(function (t) {
	    t.executeSql( createSQL2, [], function(t, r) {}, function(t, e) {
		alert('create table: ' + e.message);
	    });
	});
	
    }
}
	function prepareDatabase3() {
    var odb = getOpenDatabase();
    if(!odb) {
	dispError('Web SQL Not Supported');
	return undefined;
    } else {
	   db.transaction(function (t) {
	    t.executeSql( createSQL3, [], function(t, r) {}, function(t, e) {
		alert('create table: ' + e.message);
	    });
	});
	
    }
}



	
	function insertIntoMemberExpense(member_id,mem_name,exp_id,amount){
		 if(member_id||mem_name||exp_id||amount) {
	db.transaction( function(t) {
	    t.executeSql('INSERT INTO member_expense ( member_id, mem_name, exp_id, amount, exp_paid) VALUES ( ?, ?, ?, ?, ?)',
		[ member_id, mem_name, exp_id, amount, 'N' ]
	    ); 
	}, function(t, e){ alert('Insert row: ' + e.message); }, function() {
	   // resetTravelForm();
	});
    }
	
	}

function insertIntoPayment(member_id,amount,original){
 if(member_id||amount) {
	db.transaction( function(t) {
		t.executeSql('INSERT INTO payment ( member_id, amount, original) VALUES ( ?, ?, ?)',
			[ member_id, amount, original ]
		); 
	}, function(t, e){ alert('Insert row: ' + e.message); }, function() {
		//resetTravelForm();
	});
}

}
var last_exp_id=0;

function insertIntoExpense(expensename,creatorid,description,category,amount,date,mem_exp_array){
if(expensename||creatorid||description||category||amount||date) {
	db.transaction( function(t) {
	    t.executeSql('INSERT INTO expense ( exp_name, exp_creator_id, exp_category_id, exp_description, exp_amount, date, exp_paid ) VALUES ( ?, ?, ?, ?, ?, ?, ? )',
		[ expensename, creatorid, category, description, amount, date, 'N' ],function(t,sql_res){
		last_exp_id = sql_res.insertId;
		for(var i=0;i<mem_exp_counter;i++){
		var temp_mem_exp = mem_exp_array[i];
		insertIntoMemberExpense(temp_mem_exp['member_id'],temp_mem_exp['mem_name'],last_exp_id,temp_mem_exp['mem_amount']);
		}
		});
				
	}, function(t, e){ alert('Insert row: ' + e.message); }, function() {
	    //resetTravelForm();
	});
		
    }
}
function getPayment() {
  
		if(!db) return;
		
		var retArray=new Object();
		var temp=new Object();
    db.readTransaction(function (t) {
	t.executeSql('SELECT * FROM payment', [], function (t, r) {
	    var len = r.rows.length, i;
				for (i = 0; i < len; i++){
	   
				payment['user_id']=fb_id; 
				payment['mem_id']=String(r.rows.item(i).member_id);
				payment['amount']=r.rows.item(i).amount;
				payment['original']=r.rows.item(i).original;
				var jsonData = $.toJSON(payment);
				console.log(jsonData);
				$.ajax({
					  type: "PUT",
					  url: 'http://mymoneyslate.com/api/addPayment.php',
					  data: jsonData,
					  contentType: 'application/json', // format of request payload
					  dataType: 'json', // format of the response
					  success: function(msg) {
					  console.log("payment succesS");
					  }
				});
				payment=new Object();
				}
				clearPaymentDB();
				clearExpenseDB();
				clearMemberExpenseDB();

				
	}, function(t, e) {
	  alert('countRows: ' + e.message);
	});
    });
}	


function getExpense() {
 
		if(!db) return;
		
		var retArray=new Object();
		var temp=new Object();
    db.readTransaction(function (t) {
	t.executeSql('SELECT * FROM expense', [], function (t, r) {
	    var len = r.rows.length, i;
				for (i = 0; i < len; i++){

				console.log("getExpense");
				getMemberExpense(r.rows.item(i).exp_id,r.rows.item(i).exp_name,r.rows.item(i).exp_creator_id,r.rows.item(i).exp_category_id,r.rows.item(i).exp_description,r.rows.item(i).exp_amount,r.rows.item(i).lat,r.rows.item(i).long,r.rows.item(i).date);			
				}
				
	}, function(t, e) {
	  alert('countRows: ' + e.message);
	});
    });
}	

function getMemberExpense(id,exp_name,exp_creator_id,exp_category_id,exp_description,exp_amount,lat,longt,date) {

		if(!db) return;
		
		var retArray=new Object();
		var temp=new Object();
    db.readTransaction(function (t) {
	t.executeSql('SELECT * FROM member_expense WHERE exp_id='+id, [], function (t, r) {
	   
				var len = r.rows.length, i;
				for (i = 0; i < len; i++){
	 
				retArray=new Object();
				memberExp=new Object();
				expense=new Object();
				retArray['mem_name'] = r.rows.item(i).mem_name;
				retArray['member_id']= r.rows.item(i).member_id;
				retArray['exp_id']= r.rows.item(i).exp_id;
				retArray['mem_amount']= r.rows.item(i).amount;
			
				memberExp[i]= retArray;
				}
				expense['mem_exp']=memberExp;
				expense['exp_name']=exp_name;
				expense['expense_creator_id']=exp_creator_id;
				expense['exp_category_id']=exp_category_id;
				expense['exp_description']=exp_description;
				expense['exp_amount']=exp_amount;
				expense['lat']=lat;
				expense['long']=longt;
				expense['date']=date;
				var expenseData = $.toJSON(expense);
				console.log("just before calling puExpense.php");
				alert(expenseData);
				console.log(expenseData);
				$.ajax({
					  type: "PUT",
					  url: 'http://mymoneyslate.com/api/putExpense.php',
					  data: expenseData,
					  contentType: 'application/json', // format of request payload
					  dataType: 'json', // format of the response
					  success: function(msg) {
					  console.log("Expense success");
					  getPayment();
					
					  }
				});
				
	}, function(t, e) {
	  alert('countRows: ' + e.message);
	});
    });
		
}	
	
	function clearPaymentDB() {
    
	db.transaction(function(t) {
	    t.executeSql('DELETE FROM payment');
	});
	
    
}
	
	function clearExpenseDB() {
    
	db.transaction(function(t) {
	    t.executeSql('DELETE FROM expense');
	});
	
    
}
	
	
	function clearMemberExpenseDB() {
	      db.transaction(function(t) {
	    t.executeSql('DELETE FROM member_expense');
	});
	
    }