Docs.DocsController = Ember.ArrayController.extend({
    isEdit: false,    
    
    actions : {
        // createDoc : function () {
        //     this.set('isEdit', true);
        // },
        createDoc : function () {
            
            var fileName = this.get('fileName');
            if (!fileName.trim()) { return; }

            var content = this.get('content');
            if (!content.trim()) { return; }

            var userId = this.get('userId');

            var doc = this.store.createRecord('doc', {
                fileName: fileName,
                content: content,
                userId: userId
            });

            todo.save();            

        },

        createCancel : function () {

        },
        shit: function () {
            return 'shit';
          }.property('shit'),        


    }
});