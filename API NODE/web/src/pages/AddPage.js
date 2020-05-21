import React from 'react';
import { Container, Grid, TextField, Button } from '@material-ui/core';
import Header from '../component/Header'

export default class AddPage extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            name: "",
            artist: "",
            album: "",
            year: undefined
        }
        this.handleAlbum = this.handleAlbum.bind(this);
        this.handleArtist = this.handleArtist.bind(this);
        this.handleName = this.handleName.bind(this);
        this.handleYear = this.handleYear.bind(this);
        this.onClick = this.onClick.bind(this);
        this.onKeyPress = this.onKeyPress.bind(this);
    }

    handleName(event) {
        event.preventDefault();
        this.setState({ name: event.target.value });
    }
    handleArtist(event) {
        event.preventDefault();
        this.setState({ artist: event.target.value });
    }
    handleAlbum(event) {
        event.preventDefault();
        this.setState({ album: event.target.value });
    }
    handleYear(event) {
        event.preventDefault();
        this.setState({ year: event.target.value });
    }

    onClick() {
        let { year, album, artist, name } = this.state;
        if (!name.length) {
            window.alert('A Name must be provide !!');
            return;
        }
        if (!artist.length) {
            window.alert('An Artist must be provide !!');
            return;
        }
        if (!year) {
            window.alert('A Year must be provide !!');
            return;
        }
        if (!album.length)
            album = "none";
        fetch("http://127.0.0.1:8080/api/add/" + name + '/' + artist + '/' + album + '/' + year.toString(), { mode: 'no-cors' })
        window.location = '/add';
    }
    onKeyPress(ev) {
        if (ev.key === 'Enter') {
            // Do code here
            ev.preventDefault();
            this.onClick();
        }
    }

    render() {
        return (
            <div>
                <Header page="Add" target="/search" />
                <Container style={{ paddingTop: 16 }}>
                    <Grid container justify="center">
                        <Grid container direction="row" spacing={2}>
                            <Grid item xs={6}>
                                <TextField
                                    onKeyPress={this.onKeyPress}
                                    fullWidth
                                    placeholder="Music's Name"
                                    onChange={this.handleName}
                                />
                            </Grid>
                            <Grid item xs={6}>
                                <TextField
                                    onKeyPress={this.onKeyPress}
                                    fullWidth
                                    placeholder="Music's Album (Empty if a Single)"
                                    onChange={this.handleAlbum}
                                />
                            </Grid>
                        </Grid>
                        <Grid container direction="row" style={{ paddingTop: 10 }} spacing={2}>
                            <Grid item xs={6}>
                                <TextField
                                    onKeyPress={this.onKeyPress}
                                    placeholder="Music's Artist(s) or Group"
                                    onChange={this.handleArtist}
                                    fullWidth
                                />
                            </Grid>
                            <Grid item xs={6}>
                                <TextField
                                    onKeyPress={this.onKeyPress}
                                    type="number"
                                    placeholder="Music's Year"
                                    onChange={this.handleYear}
                                    fullWidth
                                />
                            </Grid>
                        </Grid>
                        <Grid item style={{ paddingTop: 10 }}>
                            <Button
                                onClick={this.onClick}
                            >
                                Add This Musique
                        </Button>
                        </Grid>
                    </Grid>
                </Container>
            </div>
        );
    }
}