import autocomplete from 'autocomplete.js'
import algoliasearch from 'algoliasearch'

var index = algoliasearch('DKNXL06GMM', 'b7aa0811ac3575fbc3ac715f3b0d4c84')

export const usersAutocomplete = selector => {
    index = index.initIndex('users_index')

    return autocomplete(selector, {}, {
        source: autocomplete.sources.hits(index, { hitsPerPage: 10 }),
        displayKey: 'name',
        templates: {
            suggestion (suggestion) {
                return `
                    <span> ${suggestion.name} </span>
                `
            },
            empty: `
                <div class="aa-empty"> No results. </div>
            `
        }
    })
}