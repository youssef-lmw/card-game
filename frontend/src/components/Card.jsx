import React from 'react';
import './Card.css';

const Card = ({ color, value }) => {
  return (
    <div className="card" data-color={color}>
      <div className="card-value">{value}</div>
      <div className="card-color">{color}</div>
    </div>
  );
};

export default Card;
