import { format } from 'date-fns';

export default class ProductReview {
  constructor(opts) {
    this.id = opts.review.id;
    this.baseUrl = opts.baseUrl;
    this.appId = opts.appId;
    this.renderTarget = opts.renderTarget;
    this.markup = this.getMarkup(opts.review);
    this.reviewId = opts.review.id;
    this.voting = opts.voting;
    this.showRating = opts.showRating;
    this.renderTarget.insertAdjacentHTML('beforeend', this.markup);

    /*
      At this point, the review is in the DOM.
    */

    this.allReviews = document.querySelectorAll('.k-review');
    this.$review = $(
      [...this.allReviews].filter(
        review => parseInt(review.dataset.reviewId) === this.reviewId
      )[0]
    );

    this.$upvote = this.$review.find('.k-arrow--up');
    this.$downvote = this.$review.find('.k-arrow--down');

    // detectVotes() needs $upvote/$downvote
    this.detectVotes();

    this.appendVoteListeners();
  }

  detectVotes() {
    this.userVote = window.localStorage.getItem(`yotpo_vote-${this.reviewId}`);
    if (this.userVote === 'up') {
      this.$upvote.addClass('k-arrow--voted');
    } else if (this.userVote === 'down') {
      this.$downvote.addClass('k-arrow--voted');
    }
  }

  async postVote(action) {
    $.ajax({
      url: `https://api.yotpo.com/reviews/${this.reviewId}/vote/${action}`,
      method: 'POST',
    });
  }

  appendVoteListeners() {
    this.$upvote.click(() => {
      this.handleVote(this.$upvote);
      this.$upvote.addClass('k-arrow--voted');
    });

    this.$downvote.click(() => {
      this.$downvote.addClass('k-arrow--voted');
      this.handleVote(this.$downvote);
    });
  }

  handleVote(element) {
    /*
      The goal of the use of localStorage is to prevent vote spamming/manipulation.
      This also means we can use the value here to identify if we need to set the up/down
      icon as active for the user.

      If possible, it may be better to set this on a WP user level.
    */
    if (window.localStorage.getItem(`yotpo_vote-${this.reviewId}`)) {
      // the user has already voted on this item.
      alert('you have already voted on this review.');
      element.removeClass('k-arrow--voted');
      return;
    }

    if (element === this.$upvote) {
      this.postVote('up');
      window.localStorage.setItem(`yotpo_vote-${this.reviewId}`, 'up');
    } else if (element === this.$downvote) {
      this.postVote('down');
      window.localStorage.setItem(`yotpo_vote-${this.reviewId}`, 'down');
    }
  }

  showRating() {
    console.log('showRating');
  }

  getStars() {}

  getMarkup(review, index) {
    const { title, content, user, votes_up, votes_down, id } = review;
    let { created_at } = review;

    created_at = format(new Date(created_at), 'MMMM dd, yyyy');

    const markup = /*html*/ `
      <article class="k-review" data-review-id="${id}">
        <div class="k-review--liner">
          <div class="k-review--title">
            <h3 class="k-weight--lg">${title}</h3>
          </div>
          <div class="k-review--body">
            <p>${content}</p>
          </div>
          <div class="k-review--meta">
            <p>${created_at} - ${user.display_name}</p>
          </div>
          <div class="k-review--actions">
            <div class="k-review--actions__item">
              <div class="k-arrow k-arrow--up">
                <div class="k-arrow--liner">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-up-circle">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="16 12 12 8 8 12"></polyline>
                    <line x1="12" y1="16" x2="12" y2="8"></line>
                  </svg>
                </div>
              </div>
              <p>${votes_up}</p>
            </div>
            <div class="k-review--actions__item">
              <div class="k-arrow k-arrow--down">
                <div class="k-arrow--liner">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-down-circle">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="8 12 12 16 16 12"></polyline>
                    <line x1="12" y1="8" x2="12" y2="16"></line>
                  </svg>
                </div>
              </div>
              <p>${votes_down}</p>
            </div>
          </div>
        </div>
      </article>
    `;

    return markup;
  }
}
