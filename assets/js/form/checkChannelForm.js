export default function checkChannelForm(channel) {
    let errors = [];

    if(!channel.name) {
        errors.push('Le nom est requis');
    } else if(channel.name.length < 3) {
        errors.push('Le nom doit avoir plus de 3 caractères');
    } else if(channel.name.length > 30) {
        errors.push('Le nom doit avoir moins de 30 caractères');
    }

    if(!channel.usersMax) {
        errors.push('Veuillez saisir le nombre de joueurs maximum');
    } else if(channel.usersMax < 2) {
        errors.push('Le nombre de joueurs maximum doit être plus de 1');
    } else if(channel.usersMax > 11) {
        errors.push('Le nombre de joueurs maximum doit être inférieur à 11');
    }

    if(!channel.hasPassword) {
      errors.push('Sélectionnez "non" pour ne pas saisir de mot de passe');
    } 

    if(channel.hasPassword === 1) {
        if(!channel.password) errors.push('Le mot de passe est requis');
        else if(channel.password.length < 4) errors.push('Le mot de passe doit avoir plus de 4 caractères');
        else if(channel.password.length > 20) errors.push('Le mot de passe doit avoir moins de 20 caractères');
    } 

    if(!channel.isPublic) {
        errors.push('Veuillez sélectionner la visibilité de la partie');
    }

    if(!channel.username) {
        errors.push('Veuillez saisir votre nom de joueur');
    } else if(channel.username.length < 2) {
        errors.push('Le nom de joueur doit avoir plus de 1 caractère');
    } else if(channel.username.length > 15) {
        errors.push('Le nom de joueur doit avoir moins de 15 caractères');
    }

    return errors;
}