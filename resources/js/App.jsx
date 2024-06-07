import { useEffect, useState } from "react";

//const PORT = 8000;

export default function App() {
    const [selectedCar, setSelectedCar] = useState(null);
    function handleCarSelection(id) {
        setSelectedCar(id);
    }

    return (
        <>
            {selectedCar ? (
                <CarPage
                    selectedCar={selectedCar}
                    onSelect={handleCarSelection}
                />
            ) : (
                <HomePage onSelect={handleCarSelection} />
            )}
        </>
    );
}

function HomePage({ onSelect }) {
    const [topCars, setTopCars] = useState([]);
    const [isLoading, setIsLoading] = useState(false);
    const [error, setError] = useState("");

    async function getTopCars() {
        try {
            setIsLoading(true);
            setError("");

            const res = await fetch(`http://localhost/data/get-top-cars`);
            if (!res.ok) {
                throw new Error("Kļuda ielādējot datus");
            }

            const data = await res.json();
            setTopCars(data);
        } catch (error) {
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
            {isLoading && <Loader />}
            {error && <ErrorMsg message={error} />}
            {!isLoading && !error && (
                <TopCarsContainer cars={topCars} onSelect={onSelect} />
            )}
        </>
    );
}

function TopCarsContainer({ cars, onSelect }) {
    return (
        <div className="top-cars-container">
            {cars.map((car, idx) => {
                return (
                    <TopCar
                        car={{ ...car, idx: idx }}
                        key={car.id}
                        onSelect={onSelect}
                        twoCar={idx === 1 && cars.length === 2 ? "two-car" : ""}
                    />
                );
            })}
        </div>
    );
}

function TopCar({ car, onSelect, twoCar }) {
    let imgLink =
        "http://localhost/images" === car.image
            ? "./placeholder_image.png"
            : car.image;

    return (
        <>
            <div
                style={{
                    backgroundImage: `url(${imgLink})`,
                }}
                className={"top-car-container " + twoCar}
            >
                <div className="info-container">
                    <h1>{car.model}</h1>
                    <p>{`${car.description
                        .split(" ")
                        .slice(0, 25)
                        .join(" ")}...`}</p>
                    <button
                        onClick={() => onSelect(car.id)}
                        className="top-car-i-btn"
                    >
                        Apskatīt
                    </button>
                </div>
            </div>
        </>
    );
}

function CarPage({ selectedCar, onSelect }) {
    //const [scrollPos, setScrollPos] = useState(0);
    return (
        <>
            <BackButton onSelect={onSelect} />
            <CarDetails selectedCar={selectedCar} onSelect={onSelect} />
            <RelatedContainer selectedCar={selectedCar} onSelect={onSelect} />
        </>
    );
}

function CarDetails({ selectedCar }) {
    const [carData, setCarData] = useState({});
    const [isLoading, setIsLoading] = useState(false);
    const [error, setError] = useState("");

    async function getCarData(selectedCar) {
        try {
            setIsLoading(true);
            setError("");

            const result = await fetch(
                `http://localhost/data/get-car/` + selectedCar,

                {
                    mode: "cors",
                }
            );

            if (!result.ok) {
                throw new Error("Kļūda ielādējot datus");
            }

            const data = await result.json();

            setCarData(data);
        } catch (error) {
            setError(error.message);
        } finally {
            setIsLoading(false);
        }
    }

    useEffect(() => {
        getCarData(selectedCar);
    }, [selectedCar]);

    let imgLink =
        "http://localhost/images" === carData.image
            ? "./placeholder_image.png"
            : carData.image;

    return (
        <>
            {isLoading && <Loader />}
            {error && <ErrorMsg message={error} />}
            {!isLoading && !error && (
                <div className="single-car-container">
                    <h1>{carData.model} </h1>
                    <img
                        className="car-img"
                        src={imgLink}
                        alt={`${carData.model} attēls`}
                    />

                    <div className="single-car-info-container">
                        <div className="info-item-container">
                            <span>Cena: </span>
                            <p>&euro; {carData.price}</p>
                        </div>
                        <div className="info-item-container">
                            <span>Gads: </span>
                            <p>{carData.year}</p>
                        </div>
                        <div className="info-item-container">
                            <span>Ražotājs: </span>
                            <p>{carData.manufacturer}</p>
                        </div>
                        <div className="info-item-container">
                            <span>Kategorija: </span>
                            <p>{carData.category}</p>
                        </div>
                    </div>
                    <p className="car-description">{carData.description}</p>
                </div>
            )}
        </>
    );
}

function BackButton({ onSelect }) {
    return (
        <button onClick={() => onSelect(null)} className="home-button">
            Uz sākumu
        </button>
    );
}

function RelatedContainer({ selectedCar, onSelect }) {
    const [relatedCars, setRelatedCars] = useState([]);
    const [isLoading, setIsLoading] = useState(false);
    const [error, setError] = useState("");

    async function getRelatedCars(selectedCar) {
        try {
            setIsLoading(true);
            setError("");

            const result = await fetch(
                `http://localhost/data/get-related-cars/` + selectedCar,
                { mode: "cors" }
            );

            if (!result.ok) {
                throw new Error("Kļūda ielādējot datus");
            }

            const data = await result.json();

            setRelatedCars(data);
        } catch (error) {
            setError(error.message);
        } finally {
            setIsLoading(false);
        }
    }

    useEffect(() => {
        getRelatedCars(selectedCar);
    }, [selectedCar]);

    return (
        <>
            <h1 className="related-cars-h1">Līdzīgas automašīnas</h1>
            {error && <ErrorMsg message={error} />}

            {relatedCars.length === 0 && (
                <h1 style={{ textAlign: "center", marginBottom: "100px" }}>
                    Nav atrasts!
                </h1>
            )}
            {!error && relatedCars.length != 0 && (
                <div className="related-cars-container">
                    {relatedCars.map((car) => (
                        <RelatedCar
                            car={car}
                            isLoading={isLoading}
                            onSelect={onSelect}
                            key={car.id}
                        />
                    ))}
                </div>
            )}
        </>
    );
}

function RelatedCar({ car, onSelect, isLoading }) {
    function handleScroll() {
        setTimeout(() => {
            window.scrollTo({ top: 0, behavior: "smooth" });
        }, 300);
    }

    let imgLink =
        "http://localhost/images" === car.image
            ? "./placeholder_image.png"
            : car.image;
    return (
        <>
            {isLoading && <Loader />}

            {!isLoading && (
                <div className="related-car">
                    <h5 className="related-car-h5">{car.model}</h5>
                    <img src={imgLink} alt={car.model} />

                    <button
                        className="related-car-btn"
                        onClick={() => {
                            onSelect(car.id);
                            handleScroll();
                        }}
                    >
                        Apskatīt
                    </button>
                </div>
            )}
        </>
    );
}

function Loader() {
    return <img className="loader" src="./load.gif" alt="Lūdzu, uzgaidiet!" />;
}

function ErrorMsg({ message }) {
    return (
        <div className="error-container">
            <p>{message}</p>
            <p>Lūdzu, pārlādējiet lapu!</p>
        </div>
    );
}
