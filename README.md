## Komen Spelen: Battle of Bands

This backbone web-app serves the purpose of organising bandbattle events, where bands of any genre take on other bands in a series of gigs. Per gig, one band plays and the others rate them according to set quota such as the overall experience or things like instrument expertise.

### API Cheatsheet

##### Getters (get)

- /api/bands/
- /api/bands/:id/

- /api/bands/:id/members/
- /api/bandmembers/:id/

- /api/bandbattles/
- /api/bandbattles/:id/
- /api/bandbattles/invites/checkcode/:code/

- /api/bandbattles/:id/events/
- /api/bandbattlegigs/:id/

- /api/ratings/
- /api/ratings/for/:band_id/
- /api/ratings/by/:band_id/
- /api/ratings/:id/

- /api/ratings/quota/options/
- /api/ratings/quota/options/:id

- /api/images/
- /api/images/:id/
- /api/bandbattle/:bandbattle_id/images/

##### Validation (post)

- /api/validate/banddata/
- /api/validate/ratingData/
- /api/validate/ratingData/scoreUpdate/

##### Setters: Inserts (post)

- /api/bands/bands/
- /api/bands/bands/:id/members/

- /api/bandbattles/
- /api/bandbattles/:id/invites/sendcode/
- /api/bandbattles/:id/events/

- /api/ratings/for/:band_id/

- /api/images/

##### Setters: Updates (post)

- /api/bands/:id/
- /api/bandbattles/:id/
- /api/ratings/:id/

##### Setters: Deletes (delete)

- /api/bands/:id/
- /api/bandbattles/:id/
- /bandbattles/invites/:id/
- /api/ratings/:id/
- /api/images/:id/

