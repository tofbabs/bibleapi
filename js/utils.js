var Utils = (function() {

	getData = function (url, callback, elem=null){
		jQuery.ajax({
			url: url,
			type: "GET",
			success: function (ajaxData) {

				if (ajaxData != 503) {
					console.log(ajaxData);
					callback(JSON.parse(ajaxData), elem);
				}
				// body...
			}

		});
	};

	postData = function (url, data = null){
		jQuery.ajax({
			url: url,
			type: "POST",
			data: data,
			success: function (ajaxData) {
				// body...
				console.log(ajaxData);
				return ajaxData;
			}

		});
	};

	return {
		getData: getData,
		postData: postData
	};

})();