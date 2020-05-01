export function ready_to_play(data) {
    return axios.post('/api/channel/'+ data.channel.id +'/user/ready', data);
}

export function roll_number_dice(data) {
    return axios.post('/api/channel/'+ data.channel.id +'/dice/number', data);
}

export function select_game_version(data) {
    return axios.post('/api/channel/'+ data.channel.id +'/select-game-version', data);
}

export function roll_normal_dice(data) {
    return axios.post('/api/channel/'+ data.channel.id +'/dice/version', data);
}

export function roll_white_dice(data) {
    return axios.post('/api/channel/'+ data.channel.id +'/dice/white', data);
}

export function roll_black_dice(data) {
    return axios.post('/api/channel/'+ data.channel.id +'/dice/black', data);
}

export function roll_dice_for_rating(data) {
    return axios.post('/api/channel/'+ data.channel.id +'/dice/rating', data);
}

export function vote_for_allowing_second_roll(data) {
    return axios.post('/api/channel/'+ data.channel.id +'/vote/second-roll', data);
}

export function propose_subject(data) {
    return axios.post('/api/channel/'+ data.channel.id +'/subject', data);
}