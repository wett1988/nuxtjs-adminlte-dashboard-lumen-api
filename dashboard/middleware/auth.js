import auth_init from '~plugins/auth_init'

export default function ({ app }) {

//  console.log('app')
//  console.log(app)
//
  if (process.BROWSER_BUILD) {
    console.log('auth')
    auth_init(app.store, app.router)
  }



//  console.log(store.getters['user/get'] )

//  if (store.getters.isAuth) {
//    return redirect('/')
//  }
}
