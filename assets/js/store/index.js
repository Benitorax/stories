import channel from './modules/channel';
import message from './modules/message';
import user from './modules/user';
import createLogger from '../plugins/logger';

Vue.use(Vuex);

const debug = process.env.NODE_ENV !== 'production';

export default new Vuex.Store({
    modules: {
        channel,
        message,
        user
    },
    strict: debug,
    plugins: debug ? [createLogger()] : []
});