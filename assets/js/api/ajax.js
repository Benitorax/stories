/**
 * Mocking client-server processing
 */
export function api_get(url) {
    return axios.get(url);
}

export function channel_list() {
    return axios.get('/api/channel');
}

export function channel_post(data) {
    return axios.post('/api/channel', data);
}

export function channel_add_user(data) {
    return axios.post('/api/channel/'+ data.channel.id + '/user', data);
}

export function channel_check_password(data) {
    return axios.post('/api/channel/'+ data.channel.id + '/check-password', {password: data.password});
}

export function channel_get_by_id(data) {
    return axios.get('/api/channel/'+ data.id);
}

//#################################################################

const _products = [
    {"id": 1, "title": "iPad 4 Mini", "price": 500.01, "inventory": 2},
    {"id": 2, "title": "H&M T-Shirt White", "price": 10.99, "inventory": 10},
    {"id": 3, "title": "Charli XCX - Sucker CD", "price": 19.99, "inventory": 5}
];
  
export default {
    getProducts (cb) {
        setTimeout(() => cb(_products), 100);
    },

    buyProducts (products, cb, errorCb) {
        setTimeout(() => {
            // simulate random checkout failure.
            (Math.random() > 0.5 || navigator.webdriver)
            ? cb()
            : errorCb()
        }, 100);
    }
}

// const data = require('./mock-data')
// const LATENCY = 16

// export function getAllMessages (cb) {
//   setTimeout(() => {
//     cb(data)
//   }, LATENCY)
// }

// export function createMessage ({ text, thread }, cb) {
//   const timestamp = Date.now()
//   const id = 'm_' + timestamp
//   const message = {
//     id,
//     text,
//     timestamp,
//     threadID: thread.id,
//     threadName: thread.name,
//     authorName: 'Evan'
//   }
//   setTimeout(function () {
//     cb(message)
//   }, LATENCY)
// }