ls = getLocalStorage(); //ls shall be the local storage element we use

//gets local storage elements if it exists
function getLocalStorage() {
    try {
	if( !! window.localStorage ) return window.localStorage;
    } catch(e) {
	return undefined;
    }
}

//type is an associative index, ex: 'example'
//data can be used to store JSON string for caching 
function set_local(type, data){
	ls.setItem(type, data);
}
function get_local(type){
	return ls.getItem(type);
}