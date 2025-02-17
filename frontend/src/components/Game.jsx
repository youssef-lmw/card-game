import React, { useState, useEffect } from 'react';
import Card from './Card';
import './Game.css';

const Game = () => {
  const [initialHand, setInitialHand] = useState([]);
  const [sortedHand, setSortedHand] = useState([]);
  const [loading, setLoading] = useState(false);

  const drawNewHand = async () => {
    setLoading(true);
    try {
      const response = await fetch('http://localhost:8000/api/draw');
      const data = await response.json();
      setInitialHand(data.initial_hand);
      setSortedHand(data.sorted_hand);
    } catch (error) {
      console.error('Error drawing cards:', error);
    }
    setLoading(false);
  };

  useEffect(() => {
    drawNewHand();
  }, []);

  return (
    <div className="game-container">
      <h1>Jeu de Cartes</h1>
      
      <button 
        onClick={drawNewHand}
        disabled={loading}
        className="draw-button"
      >
        {loading ? 'Tirage en cours...' : 'Tirer une nouvelle main'}
      </button>

      <div className="hands-container">
        <div className="hand">
          <h2>Main initiale</h2>
          <div className="cards">
            {initialHand.map((card, index) => (
              <Card key={`initial-${index}`} color={card.color} value={card.value} />
            ))}
          </div>
        </div>

        <div className="hand">
          <h2>Main triée</h2>
          <div className="cards">
            {sortedHand.map((card, index) => (
              <Card key={`sorted-${index}`} color={card.color} value={card.value} />
            ))}
          </div>
        </div>
      </div>
    </div>
  );
};

export default Game;
