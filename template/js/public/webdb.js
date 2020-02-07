/**
* JavaScript TinyWebDB Library
* @Object WebDataBase 
* @Method init
* @Method update
* @Method get
* @Method delete
* @Method count
* @Method search
* @Setting user
* @Setting secret
*/
var WebDataBase = {
	/*
	* Initialize WebDataBase
	* @function init
	*/
	init:function(){
		this.handle =new XMLHttpRequest();
	},
	/*
	* Private function
	* @function ajax
	*/
	ajax:function(data,callbak){
		callbak.handle = this.handle;
		this.handle.onreadystatechange = callbak;
		this.handle.open(this.api,true);
		data.user = this.user;
		data.secret = this.secret;
		var requetsData = "";
		Object.keys(data).forEach(function(key){
			if(data[key] !== undefined){
				requetsData += key+"&"+data[key];
			}
		});
		this.handle.send(requetsData);
	},
	/*
	* To update or set the value of the key
	* @funcion update
	* @param {string} key  The key to set
	* @param {string} key  The value
	*/
	update:function(key,value,success,error){
		
		this.ajax({"action":"update","tag":key,"value":value},function(){
			if(this.handle.readyState === 4 && this.handle.status !== 200){
				if(typeof(error) === "function"){error(this.handle.status);}
			}
			if(this.handle.readyState === 4 && this.handle.status === 200){
				if(typeof(success)){success(this.handle.responseText);}
			}
		});
	},
	
	get:function(key,success,error){
		this.ajax({"action":"get","tag":key},function(){
			if(this.handle.readyState === 4 && this.handle.status !== 200){
				if(typeof(error) === "function"){error(this.handle.status);}
			}
			if(this.handle.readyState === 4 && this.handle.status === 200){
				if(typeof(success)){success(this.handle.responseText);}
			}
		});
		
	},
	
	delete:function(key,success,error){
		this.ajax({"action":"get","tag":key},function(){
			if(this.handle.readyState === 4 && this.handle.status !== 200){
				if(typeof(error) === "function"){error(this.handle.status);}
			}
			if(this.handle.readyState === 4 && this.handle.status === 200){
				if(typeof(success)){success(this.handle.responseText);}
			}
		});
		
	},
	
	count:function(success,error){
		this.ajax({"action":"count"},function(){
			if(this.handle.readyState === 4 && this.handle.status !== 200){
				if(typeof(error) === "function"){error(this.handle.status);}
			}
			if(this.handle.readyState === 4 && this.handle.status === 200){
				if(typeof(success)){success(this.handle.responseText);}
			}
		});
	},
	
	search:function(key_or_value,type,start,success,error){
		this.ajax({"action":"search","tag":key_or_value,"no":start,"type":type},function(){
			if(this.handle.readyState === 4 && this.handle.status !== 200){
				if(typeof(error) === "function"){error(this.handle.status);}
			}
			if(this.handle.readyState === 4 && this.handle.status === 200){
				if(typeof(success)){success(this.handle.responseText);}
			}
		});
	},
	//XMLHttpRequest Object
	handle:null,
	//The api location
	api:"http://tinywebdb.appinventor.space/api",
	
	//User Defined: The username of the database
	user:"",
	//User Defined: The password of the database
	secret:""
};

//Lnitialize WebDataBase Object
WebDataBase.init();
