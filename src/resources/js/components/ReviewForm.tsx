import React, { useState } from 'react';
import StarRating from './StarRating';


interface ReviewFormProps {
    shopId: number;
    submitUrl: string;
}

const ReviewForm: React.FC<ReviewFormProps> = ({ shopId, submitUrl }) => {
    const [comment, setComment] = useState('');
    const [rating, setRating] = useState<number>(1);

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        const formData = new FormData();
        formData.append('comment', comment);
        formData.append('stars', rating.toString());

        fetch(submitUrl, {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            setComment('');
            setRating(1);
        })
        .catch(error => {
        });
    };

    return (
        <div className="review_form" onSubmit={handleSubmit}>
            <StarRating
                maxStars={5}
                onRatingChange={(value) => setRating(value)}
            />
            <input type="hidden" name="stars" value={rating} />
        </div>
    );
};

export default ReviewForm;
