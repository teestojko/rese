import React, { useState } from 'react';

interface StarRatingProps {
    maxStars?: number;
    onRatingChange: (rating: number) => void; // 親コンポーネントへ評価を渡す
}

const StarRating: React.FC<StarRatingProps> = ({ maxStars = 5, onRatingChange }) => {
    const [rating, setRating] = useState<number>(0);
    const [hover, setHover] = useState<number>(0);

    const handleClick = (starValue: number) => {
        setRating(starValue);
        onRatingChange(starValue);  // 親コンポーネントに通知
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
                        style={{ cursor: 'pointer', fontSize: '2em', color: starValue <= (hover || rating) ? '#FFD700' : '#CCCCCC' }}
                    >
                        ★
                    </span>
                );
            })}
        </div>
    );
};

export default StarRating;
