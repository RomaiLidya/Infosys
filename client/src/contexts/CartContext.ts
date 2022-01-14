import React from 'react';

export interface CartContext {
  cart: CartModel | null;
  setCart: (cart: CartModel | null) => void;
}

export const CartContext = React.createContext<CartContext>({
  cart: null,
  setCart: () => {}
});

export const CartProvider = CartContext.Provider;
export const CartConsumer = CartContext.Consumer;
