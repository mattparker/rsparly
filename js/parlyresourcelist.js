YUI.add('parlyresourcelist', function (Y) {


	Y.ParlyresourceList = Y.Base.create('ParlyresourceList', Y.ModelList, [], {


		sync: function (action, options, callback) {

			Y.io("http://localhost/rsparly/php/resources.php?q=school");
		}
	}, {


	});

}, '0.1', ['model-list', 'base', 'io']);
