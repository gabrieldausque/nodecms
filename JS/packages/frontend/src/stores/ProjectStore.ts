import { writable } from "svelte/store";
import type {Project} from "@nodecms/backend-data";

export const ProjectStore = writable(new Array<Project>());