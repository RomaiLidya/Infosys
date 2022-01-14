import React, { FC, Fragment, useState } from 'react';
import { Drawer, IconButton, Theme, useTheme, Hidden } from '@material-ui/core';
import { makeStyles } from '@material-ui/styles';
import { WHITE, GRADIENT_DRAWER_COLOR } from 'constants/colors';
import logo from 'images/logo.svg';
import DrawerList from './components/DrawerList';
import ChevronLeftIcon from '@material-ui/icons/ChevronLeft';
import clsx from 'clsx';

interface Props {
  openDrawer: boolean;
  currentUserData: CurrentUser | undefined;
  handleDrawerClose(): void;
  openMobile: boolean;
  handleDrawerCloseMobile: () => void;
}

const { REACT_APP_DRAWER_WIDTH = '240' } = process.env;

const useStyles = makeStyles((theme: Theme) => ({
  toolbarIcon: {
    display: 'flex',
    alignItems: 'center',
    justifyContent: 'space-beetwen',
    ...theme.mixins.toolbar
  },
  drawerPaper: {
    background: GRADIENT_DRAWER_COLOR,
    width: +REACT_APP_DRAWER_WIDTH,
    transition: theme.transitions.create('width', {
      easing: theme.transitions.easing.sharp,
      duration: theme.transitions.duration.enteringScreen
    })
  },
  logoContainer: {
    textAlign: 'center'
  },
  logo: {
    width: '50%'
  },
  chevron: {
    float: 'right',
    color: WHITE
  },
  drawerPaperClose: {
    overflowX: 'hidden',
    transition: theme.transitions.create('width', {
      easing: theme.transitions.easing.sharp,
      duration: theme.transitions.duration.leavingScreen
    }),
    width: theme.spacing(7),
    [theme.breakpoints.up('sm')]: {
      width: theme.spacing(9)
    }
  }
}));

const AppDrawer: FC<Props> = props => {
  const classes = useStyles();
  const { openDrawer, currentUserData, handleDrawerClose, openMobile, handleDrawerCloseMobile } = props;
  const theme = useTheme();

  return (
    <Fragment>
      <Hidden smUp>
        <Drawer
          variant='temporary'
          anchor={theme.direction === 'rtl' ? 'right' : 'left'}
          open={openMobile}
          onClose={handleDrawerCloseMobile}
          classes={{
            paper: classes.drawerPaper
          }}
          ModalProps={{
            keepMounted: true
          }}
        >
          <div className={classes.toolbarIcon}>
            <div className={classes.logoContainer}>
              <img src={logo} alt='' className={classes.logo} />
            </div>
            <div>
              <IconButton onClick={handleDrawerCloseMobile}>
                <ChevronLeftIcon className={classes.chevron} />
              </IconButton>
            </div>
          </div>
          <DrawerList handleDrawerClose={handleDrawerCloseMobile} currentUserData={currentUserData} />
        </Drawer>
      </Hidden>

      <Hidden xsDown implementation='css'>
        <Drawer
          open
          variant='permanent'
          classes={{
            paper: clsx(classes.drawerPaper, !openDrawer && classes.drawerPaperClose)
          }}
        >
          <div className={classes.toolbarIcon}>
            <div className={classes.logoContainer}>
              <img src={logo} alt='' className={classes.logo} />
            </div>

            <div>
              <IconButton onClick={handleDrawerClose}>
                <ChevronLeftIcon className={classes.chevron} />
              </IconButton>
            </div>
          </div>

          <DrawerList handleDrawerClose={() => console.log('')} currentUserData={currentUserData} />
        </Drawer>
      </Hidden>
    </Fragment>
  );
};

export default AppDrawer;
