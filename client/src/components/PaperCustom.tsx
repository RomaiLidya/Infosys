import { withStyles, createStyles, Theme, Paper } from '@material-ui/core';

const PaperCustom = withStyles((theme: Theme) =>
  createStyles({
    root: {
      padding: '24px',
      marginTop: '24px',
      marginBottom: '24px',
      boxShadow: '0px 5px 12px rgba(0, 0, 0, 0.08)',
      width: '100%',
      overflow: 'hidden',
    }
  })
)(Paper);

export default PaperCustom;
