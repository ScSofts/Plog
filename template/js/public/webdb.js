/**
* JavaScript TinyWebDB Library
* @Object WebDataBase 
* @Method init
* @Method update
* @Method get
* @Method delete
* @Method count
* @Method search
* @Setting user Must be set
* @Setting secret Must be set
*/
var WebDataBase = {
	/*
	* Initialize WebDataBase
	* @function init
	*/
	init:function(){
		this.handle =new XMLHttpRequest();
	},
	/**
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
	/**
	* To update or set the value of the key
	* @funcion update
	* @param {string} key  The key to set
	* @param {string} value  The value
	* @param {function} OnSuccess(responseText)
	* @param {function} OnError(status)
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
	
	/**
	* To get the value of the key
	* @function get
	* @param {string} key The key to get
	* @param {function} OnSuccess(responseText)
	* @param {function} OnError(status)
	*/
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
	/**
	* To delete a key
	* @function delete
	* @param {string} key The key to delete
	*/
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
	/**
	* To get the count of the database
	* @function count
	* @param {function} success OnSuccess(responseText)
	* @param {function} error OnError(status)
	*/
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
	/**
	* To search the database
	* @function search
	* @param {string} key_or_value  The keyword to search
	* @param {string} type  Choose in {tag,value,both},the search type
 	* @param {function} success OnSuccess(responseText)
	* @param {function} error OnError(status)
	*/
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
	//Private XMLHttpRequest Object
	handle:null,
	//Private The api location
	api:"http://tinywebdb.appinventor.space/api",
	
	//Public User Defined: The username of the database
	user:"",
	//Public User Defined: The password of the database
	secret:""
};

//Lnitialize WebDataBase Object
WebDataBase.init();
