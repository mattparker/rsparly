YUI.add('parlyresourceview', function (Y) {


	Y.ParlyresourceView = Y.Base.create('ParlyresourceView', Y.View, [], {



		template: '<li>{title}<br/><dl><dt>Summary</dt><dd>{summary}</dd></dl></li>',

		render: function () {

			var m = this.model
			return Y.substitute(this.template, {
				title: m.get("title"),
				summary: m.get("summary")
			});

		}

	}, {




	});

}, '0.1', ['view', 'base', 'substitute']);
