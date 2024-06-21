let $ = jQuery

class Search {
    // describe and create/initiate our object
    constructor() {
        this.url = `${webduelData.root_url}/wp-json/webduel/v1/search?term=`
        this.allProductsURL = `${webduelData.root_url}/wp-json/webduel/v1/all-products-search?term=`
        this.loading = $('.search-bar .loading-icon')
        this.searchIcon = $('.search-code .desktop-search')
        this.resultDiv = $('.search-code .result-div')
        this.searchField = $('#search-term')
        this.typingTimer
        this.searchBar = $('.search-bar')
        this.events()
        this.isSpinnerVisible = false
        this.previousValue
    }
    // events 
    events() {

        this.searchField.on("keyup", this.typingLogic.bind(this))
        this.searchField.on("click", this.searchFieldClickHandler.bind(this))
        // add on enter event 
        this.searchField.on("keypress", this.sendToShopPage.bind(this))
        $(document).on("click", this.documentClickHandler.bind(this))
        // redirect to result page when clicked on search icon  
        this.searchIcon.on('click', this.takeToQueryPage)
    }

    // document click handler
    documentClickHandler(e) {
        if (!this.searchBar.is(e.target) && this.searchBar.has(e.target).length === 0) {
            this.resultDiv.hide()
        }
    }
    // search field click
    searchFieldClickHandler() {
        this.resultDiv.show()
    }
    // methods
    typingLogic() {
        if (this.searchField.val() != this.previousValue) {
            clearTimeout(this.typingTimer)
            // check if the value is not empty
            if (this.searchField.val()) {
                if (!this.isSpinnerVisible) {
                    // show loading spinner
                    this.loading.show()
                    this.isSpinnerVisible = true
                }
                this.typingTimer = setTimeout(this.getResults.bind(this), 2000)
            }
            else {
                // hide loading
                this.loading.hide()
                this.isSpinnerVisible = false
            }
        }
        this.previousValue = this.searchField.val()

    }


    // get result method
    getResults() {
        const queryURL = `${this.url}${this.searchField.val()}`
        var requestOptions = {
            method: 'GET',
            redirect: 'follow'
        };

        fetch(queryURL, requestOptions)
            .then(response => response.text())
            .then(result => console.log(result))
            .catch(error => console.log('error', error));
        // send request 
        $.getJSON(queryURL, (data) => {
            this.resultDiv.show()
            if (data.length) {
                this.resultDiv.html(`<ul class="search-list">
                ${data.map(item => {
                    return `<li>
                    <a href="${item.link}"> 
                    <img src="${item.image}" alt=${item.title}/>
                    <span>${item.title}</span>
                    </a>
                    </li>`
                }).join('')}
                </ul>`)

                // get rest of the query projects
                $.getJSON(`${this.allProductsURL}${this.searchField.val()}`, (allProducts) => {

                    if (allProducts.length) {
                        $('.search-list').append(` ${allProducts.map(item => {
                            return `<li>
                            <a href="${item.link}"> 
                            <img src="${item.image}" alt=${item.title}/>
                            <span>${item.title}</span>
                            </a>
                            </li>`
                        }).join('')}`)
                    }

                })

            }
            else {
                this.resultDiv.html(`<p class="center-align medium">Nothing found</p>`)
            }
            // hide loading spinner 
            if (this.isSpinnerVisible) {
                this.loading.hide()
                this.isSpinnerVisible = false
            }
        })
    }

    // query page redirect 
    takeToQueryPage(e) {

        if ($('#search-term').val().length >= 1) {
            window.location.href = `${webduelData.root_url}/shop/?_search=${$('#search-term').val()}`;
        }

    }

    sendToShopPage(event) {
        if (event.which === 13) { // jQuery normalizes the keyCode value in 'which'
            event.preventDefault(); // Prevent the form submission

            var searchTerm = $(event.target).val();
            // var url = "https://example.com/search-page"; // Your target URL
            const url = `${location.protocol}//${location.host}/shop?_search=${encodeURIComponent(searchTerm)}`
            // Redirect to the URL with the search term included as a query parameter
            window.location.href = url;
        }
    }
}
export default Search