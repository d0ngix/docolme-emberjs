Docs.DocsRoute = Ember.Route.extend({
    model: function() {
        return this.store.find('docs');
    }
});

Docs.DocRoute = Ember.Route.extend({
    model: function(params) {
        let doc = this.store.find( 'docs', params.doc_id);
        return doc;
    },
    // renderTemplate: function () {
    //     this.render('doc');
    // }        
});

Docs.MineRoute = Ember.Route.extend({
    model: function() {
        var docs = this.store.find('docs', {userId: window.sessionStorage.getItem("uid")});
        //console.log(docs);
        return docs;
    },
    // renderTemplate: function () {
    //     this.render('docs');
    // }
});

Docs.DocsMyDocsRoute = Ember.Route.extend({
    model: function() {
        var docs = this.store.find('docs');
        return docs;
    }
});

Docs.DocsCreateRoute = Ember.Route.extend({
    model: function() {
        var doc = this.store.find('docs', {});
        return doc;
    },
    actions: {
        create: function() {
            //this.set('isEditing', true);
            // this.controller.set('model.fileName',"");
            // this.controller.set('model.contentText',"")
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


// Docs.DocsAlldocsRoute = Ember.Route.extend({
    // renderTemplate: function() {
    //     // this.render();
    //     // this.render({ outlet: 'sidebar' });
        
//       }
// });