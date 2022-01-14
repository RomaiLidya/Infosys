import React, { FC } from 'react';
import { List, makeStyles } from '@material-ui/core';
import { mdiCubeOutline, mdiLayersTripleOutline, mdiAccountMultipleOutline, mdiLogout } from '@mdi/js';
import { WHITE } from 'constants/colors';
import DrawerItem from './DrawerItem';
import { hasAccess } from 'selectors';

interface Props {
  currentUserData: CurrentUser | undefined;
  handleDrawerClose(): void;
}

const useStyles = makeStyles({
  textIcon: {
    color: WHITE,
    fontSize: 50,
    fontWeight: 'bold'
  }
});

const DrawerList: FC<Props> = props => {
  const classes = useStyles();
  const { handleDrawerClose, currentUserData } = props;
  const products = [
    { name: 'Katalog', path: '/produk' },
    { name: 'Kategori', path: '/kategori' }
  ];



  return (
    <List className={classes.textIcon}>   </List>
  );
};

export default DrawerList;
