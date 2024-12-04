import React, { useState } from 'react';

interface StarRatingProps {
    maxStars?: number;
    onRatingChange: (rating: number) => void;
}

const StarRating: React.FC<StarRatingProps> = ({ maxStars = 5, onRatingChange }) => {
    const [rating, setRating] = useState<number>(0);
    const [hover, setHover] = useState<number>(0);

    const handleClick = (starValue: number) => {
        setRating(starValue);
        onRatingChange(starValue);
    };

    return (
        <div className="star-rating">
            {[...Array(maxStars)].map((_, index) => {
                const starValue = index + 1;
                return (
                    <span
                        key={index}
                        className={`star ${starValue <= (hover || rating) ? 'filled' : ''}`}
                        onClick={() => handleClick(starValue)}
                        onMouseEnter={() => setHover(starValue)}
                        onMouseLeave={() => setHover(0)}
                    >
                        ★
                    </span>
                );
            })}
        </div>
    );
};

export default StarRating;
