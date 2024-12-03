import React, { useState } from 'react';
import StarRating from './StarRating';


interface ReviewFormProps {
    shopId: number;  // 投稿先のショップID
    submitUrl: string; // フォームの送信先URL
}

const ReviewForm: React.FC<ReviewFormProps> = ({ shopId, submitUrl }) => {
    const [comment, setComment] = useState('');
    const [rating, setRating] = useState<number>(1);

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        const formData = new FormData();
        formData.append('comment', comment);
        formData.append('stars', rating.toString());

        // フォーム送信処理を追加（AJAXなども可能）
        fetch(submitUrl, {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            // 成功処理（例えば、フォームをリセットするなど）
            setComment('');  // コメントをリセット
            setRating(1);  // 評価をリセット（初期値に戻す）
        })
        .catch(error => {
            // エラーハンドリング
        });
    };

    return (
        <div className="review_form" onSubmit={handleSubmit}>
            <StarRating
                maxStars={5}
                onRatingChange={(value) => setRating(value)}  // 評価を更新
            />
            <input type="hidden" name="stars" value={rating} />
        </div>
    );
};

export default ReviewForm;
