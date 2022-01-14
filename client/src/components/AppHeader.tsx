import React, { FC } from 'react';
import { AppBar, Badge, Grid, IconButton, Toolbar, Typography, } from '@material-ui/core';

interface Props {
  open: boolean;
  openMobile: boolean;
  handleDrawerOpen(): void;
  handleDrawerOpenMobile: () => void;
}

const AppHeader: FC<Props> = props => {
  const { open, handleDrawerOpen, handleDrawerOpenMobile } = props;


  return (
    <AppBar >
      <Toolbar>     
        
      
        <Grid container direction='row' item xs={10} sm={10} md={4} lg={4} xl={4} alignItems='center'>
          
          <Grid item xs={2} sm={2} md={2} lg={2} xl={2}>
            <IconButton >
              <Badge>
               1ST
              </Badge>
            </IconButton>
          </Grid>

          <Grid item xs={2} sm={2} md={2} lg={2} xl={2}>
          <Typography variant='h6' title="Bold" > DONASI </Typography>
          </Grid>

        </Grid>
      </Toolbar>

  
    </AppBar>
  );
};

export default AppHeader;
