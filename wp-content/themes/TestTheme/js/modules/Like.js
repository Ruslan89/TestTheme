import $ from 'jquery';

class Like {
	constructor() {
		this.events();

	}

	events() {
		$(".like-box").on("click", this.ourClickDispatcher.bind(this));
	}

	//methods
	ourClickDispatcher(e) {
		var currentLikeBox = $(e.target).closest(".like-box"); 	//Falls mehrere Likes auf einer Seite sind

		if (currentLikeBox.attr('data-exists') == 'yes') {
			this.deleteLike(currentLikeBox);
		} else {
			this.createLike(currentLikeBox);
		}
	}

	createLike(currentLikeBox) {
		$.ajax({
			beforeSend: (xhr) => {
				xhr.setRequestHeader('X-WP-Nonce', guData.nonce);
			},
			url		: guData.root_url + '/wp-json/gu/v1/like' ,
			type	: 'POST',
			data    : {'heilmittelId' : currentLikeBox.data('heilmittel')}, 
			success	: (response) => {
				currentLikeBox.attr('data-exists', 'yes');
				var likeCount = parseInt(currentLikeBox.find(".like-count").html(), 10);
				likeCount++;
				currentLikeBox.find(".like-count").html(likeCount);
				currentLikeBox.attr("data-like", response);
				console.log(response);
			},
			error	: (response) => {
				console.log(response);
			}
		});
	}

	deleteLike(currentLikeBox) {
		$.ajax({
			beforeSend: (xhr) => {
				xhr.setRequestHeader('X-WP-Nonce', guData.nonce);
			},
			url		: guData.root_url + '/wp-json/gu/v1/like', 
			data 	: {'like': currentLikeBox.attr('data-like')},
			type	: 'DELETE',
			success	: (response) => {
				currentLikeBox.attr('data-exists', 'no');
				var likeCount = parseInt(currentLikeBox.find(".like-count").html(), 10);
				likeCount--;
				currentLikeBox.find(".like-count").html(likeCount);
				currentLikeBox.attr("data-like", '');
				console.log(response);
			},
			error	: (response) => {
				console.log(response);
			}
		});
	}
}

export default Like;