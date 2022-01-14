import React, { FC, Fragment } from 'react';
import { makeStyles } from '@material-ui/styles';
import { Avatar, ClickAwayListener, Divider, Grid, List, ListSubheader, ListItem, ListItemAvatar, Typography, Theme } from '@material-ui/core';
import Skeleton from 'react-loading-skeleton';
import match from 'autosuggest-highlight/match';
import parse from 'autosuggest-highlight/parse';
import useRouter from 'hooks/useRouter';
import { BLUE_PRIMARY } from 'constants/colors';

interface Props {
  setOpenPopper?: React.Dispatch<React.SetStateAction<boolean>>;
  isLoadingData?: boolean;
  partners?: PartnerModel[];
  query?: string;
}

const useStyles = makeStyles((theme: Theme) => ({
  list: {
    width: '100%',
    backgroundColor: theme.palette.background.paper,
    overflow: 'auto',
    maxHeight: 450,
    borderRadius: '5px'
  },
  subHeader: {
    color: BLUE_PRIMARY
  },
  inline: {
    display: 'inline'
  },
  avatar: {
    backgroundColor: theme.palette.primary.main
  },
  notFound: {
    marginTop: theme.spacing(1)
  },
  skeleton: {
    padding: theme.spacing(1)
  }
}));

const PartnerList: FC<Props> = props => {
  const classes = useStyles(props);
  const { history } = useRouter();

  const { isLoadingData, partners, query, setOpenPopper } = props;
  const dataLength = partners !== undefined ? partners.length : 5;

  const handleClickListItem = (partnerId: number) => {
    history.push({ pathname: `/partners/${partnerId}`, state: { selectedTab: 0 } });
    setOpenPopper && setOpenPopper(false);
  };

  const renderSkeleton = () => {
    return [1, 2, 3, 4, 5].map((value, index) => (
      <Fragment key={index}>
        <ListItem alignItems='flex-start' button>
          <ListItemAvatar>
            <Skeleton circle={true} height={36} width={36} />
          </ListItemAvatar>
          <Fragment>
            <Grid container spacing={1}>
              <Grid item xs={12} sm={6}>
                <div className={classes.skeleton}>
                  <Skeleton width={130} />
                </div>
                <div className={classes.skeleton}>
                  <Skeleton width={130} />
                </div>
              </Grid>
              <Grid item xs={12} sm={6}>
                <div className={classes.skeleton}>
                  <Skeleton width={130} />
                </div>
                <div className={classes.skeleton}>
                  <Skeleton width={130} />
                </div>
              </Grid>
              <Grid item xs={12}>
                <div className={classes.skeleton}>
                  <Skeleton width={280} />
                </div>
                <div className={classes.skeleton}>
                  <Skeleton width={280} />
                </div>
                <div className={classes.skeleton}>
                  <Skeleton width={280} />
                </div>
              </Grid>
            </Grid>
          </Fragment>
        </ListItem>
        {index !== dataLength - 1 && <Divider />}
      </Fragment>
    ));
  };

  const renderNoResult = () => {
    return (
      <Typography variant='body2' align='center' color='textSecondary' className={classes.notFound}>
        No results found for query <span style={{ color: BLUE_PRIMARY }}>{query}</span>
      </Typography>
    );
  };

  const renderResult = () => {
    return (
      partners &&
      partners.map((partner, index) => {
        const suggestionOne = partner.name;
        const matchOne = match(suggestionOne, query === undefined ? '' : query);
        const partOne = parse(suggestionOne, matchOne);

        const suggestionTwo = partner.phoneNumber;
        const matchTwo = match(suggestionTwo, query === undefined ? '' : query);
        const partTwo = parse(suggestionTwo, matchTwo);

        const suggestionThree = partner.regionName;
        const matchThree = match(suggestionThree, query === undefined ? '' : query);
        const partThree = parse(suggestionThree, matchThree);

        let initialName: any = [];
        if (partner.name) {
          const splitedNames = partner.name.split(' ');
          splitedNames.map((splitedName, index) => {
            if (index === 0 || index === splitedNames.length - 1) {
              if (splitedName[0]) {
                initialName.push(splitedName[0].toUpperCase());
              } else {
                initialName.push(splitedNames[index - 1][0] ? splitedNames[index - 1][0].toUpperCase() : '');
              }
            }
            return initialName;
          });
        }

        return (
          <Fragment key={index}>
            <ListItem alignItems='flex-start' button onClick={event => handleClickListItem(partner.id)}>
              <ListItemAvatar>
                <Avatar className={classes.avatar}>{initialName.join('')}</Avatar>
              </ListItemAvatar>
              <Fragment>
                <Grid container spacing={1}>
                  <Grid item xs={12} sm={6}>
                    <Typography variant='subtitle1' align='left' color='primary'>
                      {partOne.map((part, index) =>
                        part.highlight ? (
                          <span key={String(index)} style={{ color: BLUE_PRIMARY }}>
                            {part.text}
                          </span>
                        ) : (
                          part.text
                        )
                      )}
                    </Typography>
                    <Typography variant='body2' align='left' color='textSecondary'>
                      {partThree.map((part, index) =>
                        part.highlight ? (
                          <span key={String(index)} style={{ color: BLUE_PRIMARY }}>
                            {part.text}
                          </span>
                        ) : (
                          part.text
                        )
                      )}
                    </Typography>
                  </Grid>
                </Grid>
              </Fragment>
            </ListItem>
            {index !== dataLength - 1 && <Divider />}
          </Fragment>
        );
      })
    );
  };

  const renderContent = () => {
    if (isLoadingData) {
      return renderSkeleton();
    } else {
      if (dataLength === 0) {
        return renderNoResult();
      } else {
        return renderResult();
      }
    }
  };

  return (
    <ClickAwayListener onClickAway={event => setOpenPopper && setOpenPopper(false)}>
      <List subheader={<ListSubheader className={classes.subHeader}>Search Result</ListSubheader>} className={classes.list}>
        <Divider />
        {renderContent()}
      </List>
    </ClickAwayListener>
  );
};

export default PartnerList;
