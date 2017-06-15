import BasePerimeter from './BasePerimeter'

export default new BasePerimeter({
  purpose: 'user',

  can: {
    read: () => true,

    create(){
      return this.isAdmin()
    },

    // only admin or moderator can update articles
    update(user) {
//      return this.isAmin() || (this.isCreator(article) && this.isModerator());
//      return true
      return this.isAdmin() || this.isOwner(user)
    },

    // if user can update articles then she can also destroy them
    destroy(user) {
//      return this.isAllowed('update', article);
      return this.isAdmin()
    }
  },

//  secretNotes(article) {
//    this.guard('update', article);
//
//    return article.secretNotes;
//  },

  isAdmin() {

//    console.log(this.child)

    return _.includes(this.child.roles, 'admin');

//    return this.child.role === 'admin'
  },

//  isModerator() {
//    return this.child.role === 'moderator';
//  },

  isOwner(user) {
    return this.child.id === user.id
  },

//  expose: [
//    'secretNotes'
//  ]

})
