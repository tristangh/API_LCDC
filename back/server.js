var express = require('express');
var bodyParser = require('body-parser');
var mongoose = require('mongoose');
var port = process.env.PORT || 8080;
var app = express();
var cors = require('cors');

//init
app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());
app.use(cors());

mongoose.connect('mongodb://localhost/books1936');

var bookSchema = mongoose.Schema({
    nom_musique: String,
    nom_artiste: String,
    album: String,
    annee_publication: String,
});

var Book = mongoose.model('Book', bookSchema);

var router = express.Router();

router.get('/add/:name/:artist/:album/:year/', async (req, res) => {
    let status = 200;
    try {
        let book = await Book.create({
            "nom_musique": req.params.name,
            "nom_artiste": req.params.artist,
            "album": req.params.album,
            "annee_publication": req.params.year
        });
        book.save();
    }
    catch (e) {
        status = 500;
    }
    res.send({
        status: status
    });
})

router.get('/search/:name', async (req, res) => {
    let result = {
        "other": [],
        "match": null
    }
    try {
        const cursor = Book.find().cursor();

        for (let element = await cursor.next(); element != null; element = await cursor.next()) {
            // Use `doc`
            if (element.nom_musique === req.params.name) {
                result.match = {
                    name: element.nom_musique,
                    artist: element.nom_artiste,
                    album: element.album,
                    year: element.annee_publication
                }
                const cursor2 = Book.find().cursor();
                for (let element = await cursor2.next(); element != null; element = await cursor2.next()) {
                    if (result.match.artist === element.nom_artiste && result.match.name !== element.nom_musique) {
                        result.other.push({
                            name: element.nom_musique,
                            artist: element.nom_artiste,
                            album: element.album,
                            year: element.annee_publication
                        })
                    }
                }
            }
        }
    }
    catch (e) {
        res.send({
            status: 500,
            match: result.match,
            other: result.other
        })
    }
    if (!result.other.length)
        result.other = null;
    res.send({
        status: 200,
        match: result.match,
        other: result.other
    })
})

app.use('/api', router);
app.listen(port, function () {
    console.log('Listening on port ' + port);
})