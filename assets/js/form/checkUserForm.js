export default function checkChannelForm(username, hasPassword, password) {
    let errors = [];

    if(!username) {
        errors.push('Le nom de joueur est requis');
    } else if(username.length < 2) {
        errors.push('Le nom de joueur doit avoir plus de 1 caractère');
    } else if(username.length > 15) {
        errors.push('Le nom de joueur doit avoir moins de 15 caractères');
    }

    if(hasPassword == 1) {
        if(!password) errors.push('Le mot de passe est requis');
        else if(password.length < 4) errors.push('Le mot de passe doit avoir plus de 4 caractères');
        else if(password.length > 20) errors.push('Le mot de passe doit avoir moins de 20 caractères');
    } 

    return errors;
}