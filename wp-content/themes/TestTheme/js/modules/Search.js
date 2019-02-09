import $ from 'jquery';

class Search {
// 1. describe and create/initiate our object
	constructor(){
		this.addSearchHTML();
		this.resultsDiv			= $("#search-overlay__results");
		this.openButton 		= $(".js-search-trigger");
		this.closeButton 		= $(".search-overlay__close");
		this.searchOverlay 		= $(".search-overlay");
		this.searchField		= $("#search-term");
		this.events();
		this.isOverlayOpen		= false;
		this.isSpinnerVisible 	= false;
		this.previousValue;
		this.typingTimer;
	}

// 2. Bei welcher Aktion, soll was passieren
	events() {
		this.openButton.on("click", this.openOverlay.bind(this));
		this.closeButton.on("click", this.closeOverlay.bind(this));
		$(document).on("keydown", this.keyPressDispatcher.bind(this));
		this.searchField.on("keyup", this.typingLogic.bind(this));
	}

// 3. methods (function, action...)s
	typingLogic () {
		if(this.searchField.val() != this.previousValue) {
			clearTimeout(this.typingTimer);

			if(this.searchField.val()) {
				if (!this.isSpinnerVisible){
			this.resultsDiv.html('<div class="spinner-loader"></div>');
			this.isSpinnerVisible = true;
		}
		this.typingTimer = setTimeout(this.getResults.bind(this), 750);
			} else {
				this.resultsDiv.html('');
				this.isSpinnerVisible = false;
			}
		
		}
		
		this.previousValue = this.searchField.val();
	}
	getResults() {
		$.getJSON(guData.root_url + '/wp-json/gu/v1/search?term=' + this.searchField.val(), (results) => {	//Einlesen der eigenen Suchroute und dessen Ergebnisses
			this.resultsDiv.html(`
				<div class="row">				
					<div class="one-third">
						<h2 class="search-overlay__section-title">Beschwerde(n)</h2>
						${results.beschwerden.length ? '<ul class="link-list min-list">' : `<p>Keine Beschwerden gefunden. <a href="${guData.root_url}/beschwerden">Alle Beschwerden</a></p>`}
						${results.beschwerden.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`).join('')}
						${results.beschwerden.length ? '</ul>' : ''}
						
						<h2 class="search-overlay__section-title">Magazin Artikel</h2>
						${results.magazin.length ? '<ul class="link-list min-list">' : `<p>Keine Artikel gefunden. <a href="${guData.root_url}/magazin">Zum Magazin</a></p>`}			
						${results.magazin.map(item => `<li><a href="${item.permalink}">${item.title}</a> ${item.postType == 'post' ? `von ${item.authorName}` : ''}</li>`).join('')}	
						${results.magazin.length ? '</ul>' : ''}					
					</div>
					<div class="one-third">
						<h2 class="search-overlay__section-title">Heilmittel</h2>
						${results.heilmittel.length ? '<ul class="link-list min-list">' : `<p>Kein Heilmittel gefunden. <a href="${guData.root_url}/heilmittel">Alle Heilmittel</a></p>`}
						${results.heilmittel.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`).join('')}
						${results.heilmittel.length ? '</ul>' : ''}
						
					</div>
					<div class="one-third">					
						<h2 class="search-overlay__section-title">Vitalstoff(e)</h2>
						${results.vitalstoffe.length ? '<ul class="link-list min-list">' : `<p>Keinen Vitalstoff gefunden. <a href="${guData.root_url}/vitalstoffe">Alle Vitalstoffe</a></p>`}
						${results.vitalstoffe.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`).join('')}
						${results.vitalstoffe.length ? '</ul>' : ''}

						<h2 class="search-overlay__section-title">Sonstiges</h2>
						${results.sonstiges.length ? '<ul class="link-list min-list">' : '<p>Keine sonstigen Einträge</p>'}
						${results.sonstiges.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`).join('')}
						${results.sonstiges.length ? '</ul>' : ''}
					</div>
				</div>
			`);
			this.isSpinnerVisible = false;
		});
	}


	keyPressDispatcher(e) {

	//	console.log(e.keyCode);  //In Chrome->Console: KeyCode der Tasten ablesen fuer Shortcuts

		if(e.keyCode == 83 && !this.isOverlayOpen && !$("input, textarea").is(':focus')) {
			this.openOverlay();
		}

		if(e.keyCode == 27 && this.isOverlayOpen && !$("input, textarea").is(':focus')){
			this.closeOverlay();
		}

		if(e.keyCode == 67 && this.isOverlayOpen && !$("input, textarea").is(':focus')){
			this.closeOverlay();
		}
	}

	openOverlay() {
		this.searchOverlay.addClass("search-overlay--active");
		$("body").addClass("body-no-scroll");
		this.searchField.val('');
		setTimeout( () => {this.searchField.focus();}, 301);
		this.isOverlayOpen = true;

	return false;
	}

	closeOverlay(){
		this.searchOverlay.removeClass("search-overlay--active");
		$("body").removeClass("body-no-scroll");
		this.isOverlayOpen = false;
	}

	addSearchHTML() {
		$("body").append(`
			<div class="search-overlay">
				<div class="search-overlay__top">
			      <div class="container">
			        <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
			        <input type="text" class="search-term" placeholder="Wonach suchst du?" id="search-term">
			        <i class="fa fa-window-close  search-overlay__close" aria-hidden="true"></i>
			      </div>  
			    </div>

			    <div class="container">
			    <div id="search-overlay__results"></div>
		    </div>

			</div>  
			`);
	}
}

export default Search;




