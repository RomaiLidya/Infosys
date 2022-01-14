import React, { FC, Fragment, useContext, ComponentType } from 'react';
import { SvgIconProps } from '@material-ui/core/SvgIcon';
import { ListItem, ListItemIcon, ListItemText, Tooltip, Theme } from '@material-ui/core';
import { makeStyles } from '@material-ui/styles';
import ExpandLess from '@material-ui/icons/ExpandLess';
import List from '@material-ui/core/List';
import ExpandMore from '@material-ui/icons/ExpandMore';
import Collapse from '@material-ui/core/Collapse';
import { WHITE } from 'constants/colors';
import IconMdi from '@mdi/react';
import { LOGOUT_URL } from 'constants/url';
import { CurrentUserContext } from 'contexts/CurrentUserContext';
import axios from 'axios';
import useRouter from 'hooks/useRouter';

interface Props {
  Icon?: ComponentType<SvgIconProps>;
  path: string;
  iconMdi?: string;
  label: string;
  child?: boolean;
  childData?: ChildDrawerMenuModel[];
  handleDrawerClose(): void;
}

const useStyles = makeStyles((theme: Theme) => ({
  colorDrawer: {
    color: WHITE,
    fontSize: '20px'
  },
  textDrawer: {
    fontSize: 40
  },
  nested: {
    paddingLeft: theme.spacing(8)
  }
}));

const DrawerItem: FC<Props> = props => {
  const { history } = useRouter();
  const classes = useStyles();
  const { unsetCurrentUser } = useContext(CurrentUserContext);
  const { Icon, path, label, iconMdi, child, childData, handleDrawerClose } = props;

  const [open, setOpen] = React.useState(false);

  const onClickHandler = (pathChild?: string): React.MouseEventHandler => async () => {
    if (path === 'logout') {
      try {
        await axios.post(LOGOUT_URL);
      } catch (err) {
        console.log(err);
      }
      unsetCurrentUser();
      history.push('/');
      handleDrawerClose();
    } else if (path === '#') {
      setOpen(!open);
      if (pathChild) {
        setOpen(true);
        history.push(pathChild);
        handleDrawerClose();
      }
    } else {
      history.push(path);
      handleDrawerClose();
    }
  };

  return (
    <Tooltip title={label} placement='right'>
      <List component='nav' aria-labelledby='nested-list-subheader'>
        <ListItem button onClick={onClickHandler()}>
          <ListItemIcon>
            {Icon ? (
              <Fragment>
                <Icon className={classes.colorDrawer} />
              </Fragment>
            ) : (
              <Fragment>
                <IconMdi path={iconMdi ? iconMdi : ''} size={1} color={WHITE} />
              </Fragment>
            )}
          </ListItemIcon>
          <ListItemText primary={label} />
          {child && (open ? <ExpandLess /> : <ExpandMore />)}
        </ListItem>
        <Collapse in={open} timeout='auto' unmountOnExit>
          <List component='div' disablePadding>
            {childData &&
              childData.map((value, index) => (
                <ListItem key={index} button className={classes.nested}>
                  <ListItemText primary={value.name} onClick={onClickHandler(value.path)} />
                </ListItem>
              ))}
          </List>
        </Collapse>
      </List>
    </Tooltip>
  );
};

export default DrawerItem;
