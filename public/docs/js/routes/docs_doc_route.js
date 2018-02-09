Docs.DocsRoute = Ember.Route.extend({
    model: function() {
        var doc = this.store.find('docs');
        return doc;
      }
});

Docs.DocRoute = Ember.Route.extend({
    model: function(params) {
        return this.store.find( 'docs', params.doc_id);
      }    
});

Docs.DocsCreateRoute = Ember.Route.extend({
    // model: function() {
    //     var doc = this.store.find('docs');
    //     return doc;
    // },
    actions: {
        create: function() {
            //this.set('isEditing', true);
            this.controller.set('model.fileName',"");
            this.controller.set('model.contentText',"")
        },

        doneCreating: function() {

            var fileName = this.controller.get('model.fileName')
            if (!fileName.trim()) { return; }

            var contentText = this.controller.get('model.contentText');
            if (!contentText.trim()) { return; }

            var doc = this.store.createRecord('docs', {
                fileName: fileName,
                contentText: contentText,
                userId: 1
            });

            doc.save();            
            
            this.transitionTo('docs');
        },

    },
    setupController: function(controller, model) {
        controller.set('model', model);
      },
    renderTemplate : function (controller) {
        //this.set('fileName', 'TEST!@#');
        this.render ('doc/edit', {controller: controller})
    },    

});