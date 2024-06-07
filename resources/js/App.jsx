import { useEffect, useState } from "react";

export default function App() {
    const [selectedCar, setSelectedCar] = useState(null);
    function handleCarSelection(id) {
        setSelectedCar(id);
    }

    return (
        <>
            {selectedCar ? (
                <CarPage selectedCar={selectedCar} />
            ) : (
                <HomePage onselect={handleCarSelection} />
            )}
        </>
    );
}

function HomePage({ onselect }) {
    const [topCars, setTopCars] = useState([]);
    const [isLoading, setIsLoading] = useState(false);
    const [error, setError] = useState("");

    async function getTopCars() {
        try {
            setIsLoading(true);
            setError("");
            const res = await fetch("http://localhost/data/get-top-cars");
            if (!res.ok) {
                throw new Error("Kļuda ielādējot datus");
            }

            const data = await res.json();
            setTopCars(data);
        } catch (error) {
            console.log(error);
            setError(error.message);
        } finally {
            setIsLoading(false);
        }
    }

    useEffect(() => {
        getTopCars();
    }, []);

    return (
        <>
            <h1>Lauris</h1>
            {isLoading && <Loading />}
            {error && <ErrorMsg message={error} />}
            {!isLoading &&
                !error &&
                topCars.map((car, idx) => (
                    <TopCar
                        car={{ ...car, idx: idx }}
                        key={car.id}
                        onselect={onselect}
                    />
                ))}
        </>
    );
}

function TopCar({ car, onselect }) {
    return (
        <div className="row mb-5 pt-5 pb-5 bg-light">
            <div
                className={`col-md-6 mt-2 px-5 ${
                    car.idx % 2 === 0
                        ? "text-start order-2"
                        : "text-end order-1"
                }`}
            >
                <p className="display-4">{car.model}</p>
                <p className="lead">
                    {car.description.split(" ").slice(0, 32).join(" ") + "..."}
                </p>
                <button
                    className="btn btn-success"
                    onClick={() => onselect(car.id)}
                >
                    Apskatīt
                </button>
            </div>
            <div
                className={`col-md-6 text-center ${
                    car.idx % 2 === 0 ? "order-1" : "order-2"
                }`}
            >
                <img
                    className="img-fluid img-thumbnail rounded-lg w-50"
                    alt={car.name}
                    src={car.image}
                />
            </div>
        </div>
    );
}

function CarPage({ selectedCar }) {
    return (
        <>
            <p>Auto {selectedCar} ir izvēlēts</p>
        </>
    );
}

function Loading() {
    return (
        <div className="row mb-5 mt-5">
            <div className="text-center">
                <img
                    src="./loader.gif"
                    alt="Lūdzu, uzgaidiet!"
                    className="mx-auto d-block"
                />
            </div>
        </div>
    );
}

function ErrorMsg({ message }) {
    return (
        <div className="alert alert-danger">
            <p>{message}</p>
            <p>Lūdzu, pārlādējiet lapu!</p>
        </div>
    );
}
