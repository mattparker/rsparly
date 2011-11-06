YUI.add('parlyresourcelistview', function (Y) {


	Y.ParlyresourceListView = Y.Base.create('ParlyresourceListView', Y.View, [], {


		template: '<h1>Parliamentary resources</h1><ol/>',

		modelView: null,


		initializer: function (config) {
		    if (config && config.modelList) {
		      // Store the modelList config value as a property on this view instance.
		      this.modelList = config.modelList;

		      // Re-render the view whenever a model is added to or removed from the
		      // model list, or when the entire list is refreshed.
		      this.modelList.after(['add', 'remove', 'refresh', 'reset'], this.render, this);
		    }
	  	},



		render: function () {

			var content = this.template,
			    modelView = this.modelView;

			this.modelList.each(function (n) {
				
				modelView.model = n;
				content += modelView.render();
			});

			this.container.setContent(content);
			return this;
		}
	

	}, {


	});

}, '0.1', ['view', 'base']);
