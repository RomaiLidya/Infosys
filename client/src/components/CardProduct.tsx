import React, { FC } from 'react';
import { Card, CardContent, CardMedia, Typography, makeStyles } from '@material-ui/core';

interface Props {
  product: ProductModel;
}

const useStyles = makeStyles({
  root: {
    display: 'flex',
    minWidth: 250,
    width: '100%'
  },
  details: {
    display: 'flex',
    flexDirection: 'column'
  },
  content: {
    flex: '1 0 auto'
  },
  cover: {
    width: 75
  }
});

const CardProduct: FC<Props> = props => {
  const classes = useStyles();
  const { product } = props;

  return (
    <Card className={classes.root}>
      <CardMedia className={classes.cover} image={product.ProductImage && product.ProductImage.url} title={product.productName} />

      <div className={classes.details}>
        <CardContent className={classes.content}>
          <Typography variant='subtitle1'>{product.productName}</Typography>
          <Typography variant='subtitle1' color='textSecondary'>
            {product.productCode}
          </Typography>

          <Typography variant='subtitle1' color='textSecondary'>
            {`Stok:  ${product.totalStock - (product.holdItem || 0)}/${product.typeUnit}`}
          </Typography>
        </CardContent>
      </div>
    </Card>
  );
};

export default CardProduct;
