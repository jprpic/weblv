export const translations = {
    methods:{
        __(key, replacements = {}){
            let translation = window._translations[key] || key;
            return translation;
        }
    }
}
