import { ready_to_play, roll_number_dice,select_game_version, 
    roll_normal_dice, roll_white_dice, roll_black_dice, 
    vote_for_allowing_second_roll, propose_subject, roll_dice_for_rating 
} from '../api/game_ajax';

export function readyToPlay(data) {
    return ready_to_play(data).then(response => {
        let user = JSON.parse(response.data.user);
        let channel = JSON.parse(response.data.channel);
        console.log('aaa', user, channel);
        return {user, channel};
    });
}

export function rollNumberDice(data) {
    return roll_number_dice(data).then(response => {
        let user = JSON.parse(response.data.user);
        let channel = JSON.parse(response.data.channel);

        return {user, channel};
    });
}

export function selectGameVersion(data) {
    return select_game_version(data).then(response => {
        let user = JSON.parse(response.data.user);
        let channel = JSON.parse(response.data.channel);

        return {user, channel};
    });
}

export function rollNormalDice(data) {
    return roll_normal_dice(data).then(response => {
        let user = JSON.parse(response.data.user);
        let channel = JSON.parse(response.data.channel);

        return {user, channel};
    });
}

export function rollWhiteDice(data) {
    return roll_white_dice(data).then(response => {
        let user = JSON.parse(response.data.user);
        let channel = JSON.parse(response.data.channel);

        return {user, channel};
    });
}

export function rollBlackDice(data) {
    return roll_black_dice(data).then(response => {
        let user = JSON.parse(response.data.user);
        let channel = JSON.parse(response.data.channel);

        return {user, channel};
    });
}

export function rollDiceForRating(data) {
    return roll_dice_for_rating(data).then(response => {
        let user = JSON.parse(response.data.user);
        let channel = JSON.parse(response.data.channel);

        return {user, channel};
    });
}

export function voteForAllowingSecondRoll(data) {
    return vote_for_allowing_second_roll(data).then(response => {
        let user = JSON.parse(response.data.user);
        let channel = JSON.parse(response.data.channel);

        return {user, channel};
    });
}

export function proposeSubject(data) {
    return propose_subject(data).then(response => {
        let user = JSON.parse(response.data.user);
        let channel = JSON.parse(response.data.channel);

        return {user, channel};
    });
}
