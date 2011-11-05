YUI.add('parlyresource', function (Y) {


	Y.Parlyresource = Y.Base.create('Parlyresource', Y.Model, [], {


	}, {

		ATTRS: {
			title: {},
			summary: {},
			href: {}
		}

	});

}, '0.1', ['model', 'base']);
