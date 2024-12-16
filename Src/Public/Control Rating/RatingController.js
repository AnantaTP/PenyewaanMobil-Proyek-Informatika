// controller/RatingController.js

import RatingModel from '../model/RatingModel.js';

class RatingController {
    constructor(view) {
        this.model = new RatingModel();
        this.view = view;
        this.view.bindAddRating(this.handleAddRating.bind(this));
    }

    handleAddRating(rating) {
        this.model.addRating(rating);
        this.view.updateAverageRating(this.model.getAverageRating());
    }   
}

export default RatingController;
