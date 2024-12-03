import ReactDOM from 'react-dom/client';
import ReviewForm from './components/ReviewForm';


const shopId = (window as any).SHOP_ID;

const App = () => {
    return <ReviewForm shopId={shopId} submitUrl={`/evaluations-store/${shopId}`} />;
};

const root = ReactDOM.createRoot(document.getElementById('app')!);
root.render(<App />);
