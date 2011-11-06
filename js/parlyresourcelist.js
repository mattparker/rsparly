YUI.add('parlyresourcelist', function (Y) {


	Y.ParlyresourceList = Y.Base.create('ParlyresourceList', Y.ModelList, [], {



		sync: function (action, options, callback) {

			var that = this;

			Y.io("http://localhost/rsparly/php/resources.php?q=school", {
				on: {
					complete: Y.bind(that.parse, that)
				}	      
			});
		},



				

		parse: function (id, resp) {
			
			var res, meta, jsonData;

			try {
				res = Y.JSON.parse(resp.responseText);
				this.reset(res.results);

			} catch (e) {
				console.log("Couldn't parse data", resp.responseText, e);
			}

		}


	}, {


	});

}, '0.1', ['model-list', 'base', 'io', 'json']);
