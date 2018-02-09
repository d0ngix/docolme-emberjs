
Docs.Router.map( function () {
    this.resource( 'docs', { path: '/' }, function () {
        this.route('edit');
        this.route('create');
        this.resource('doc', {path: ':doc_id'});
        this.route( 'login');
    } )
} );


