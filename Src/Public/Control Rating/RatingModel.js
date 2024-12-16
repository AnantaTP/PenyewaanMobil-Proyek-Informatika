// model/RatingModel.js

class RatingModel {
    constructor() {
        this.ratings = [];
    }

    addRating(rating) {
        this.ratings.push(rating);
    }

    getAverageRating() {
        const total = this.ratings.reduce((acc, rating) => acc + rating, 0);
        return this.ratings.length ? (total / this.ratings.length).toFixed(1) : "No ratings yet";
    }
}

export default RatingModel;
