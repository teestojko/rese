import ReactDOM from 'react-dom/client'; // 'react-dom/client' からインポート
import ReviewForm from './components/ReviewForm'; // 正しいインポートパス


const shopId = (window as any).SHOP_ID;

const App = () => {
    return <ReviewForm shopId={shopId} submitUrl={`/evaluations-store/${shopId}`} />;
};

// React 18 の方法でマウント
const root = ReactDOM.createRoot(document.getElementById('app')!); // 'createRoot' を使用
root.render(<App />);
