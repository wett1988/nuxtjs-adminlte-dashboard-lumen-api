import { HeadGoverness } from 'vue-kindergarten';

export default class RouteGoverness extends HeadGoverness {
  guard(action, { next }) {

    console.log('action')
    console.log(action)

    // or your very own logic to redirect user
    // see. https://github.com/JiriChara/vue-kindergarten/issues/5 for inspiration
    return this.isAllowed(action) ? next() : next('/');
  }
}
